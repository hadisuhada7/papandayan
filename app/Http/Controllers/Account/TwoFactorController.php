<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Authenticator;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show 2FA setup page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('account.two-factor.index', [
            'user' => $user,
            'google2fa_enabled' => $user->google2fa_enabled
        ]);
    }

    /**
     * Enable 2FA for user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request)
    {
        $user = auth()->user();
        
        // Generate new secret
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        
        // Store secret in session temporarily
        session(['google2fa_secret' => $secret]);
        
        // Generate QR Code URL
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );
        
        // Generate QR code as SVG
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCodeSvg = $writer->writeString($qrCodeUrl);
        
        return view('account.two-factor.enable', [
            'secret' => $secret,
            'qrCodeSvg' => $qrCodeSvg
        ]);
    }

    /**
     * Verify and activate 2FA
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|numeric'
        ]);

        $user = auth()->user();
        $secret = session('google2fa_secret');
        
        if (!$secret) {
            return redirect()->route('account.two-factor.index')
                ->with('error', '2FA code not found. Please try again.');
        }

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $request->one_time_password);

        if ($valid) {
            // Save secret to user
            $user->google2fa_secret = encrypt($secret);
            $user->google2fa_enabled = true;
            $user->save();
            
            // Clear session
            session()->forget('google2fa_secret');
            
            return redirect()->route('account.two-factor.index')
                ->with('success', '2FA successfully enabled.');
        }

        return back()->withErrors(['one_time_password' => 'Invalid OTP code. Please try again.']);
    }

    /**
     * Disable 2FA for user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|current_password'
        ]);

        $user = auth()->user();
        $user->google2fa_secret = null;
        $user->google2fa_enabled = false;
        $user->save();

        return redirect()->route('account.two-factor.index')
            ->with('success', '2FA successfully disabled.');
    }
}
