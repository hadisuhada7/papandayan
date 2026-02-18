<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->google2fa_enabled) {
            // Log out the user
            auth()->logout();
            
            // Store user id in session for 2FA verification
            $request->session()->put('2fa:user:id', $user->id);
            
            return redirect()->route('login.2fa');
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Show 2FA verification form
     *
     * @return \Illuminate\View\View
     */
    public function show2faForm()
    {
        if (!session()->has('2fa:user:id')) {
            return redirect()->route('login');
        }

        return view('auth.2fa');
    }

    /**
     * Verify 2FA code
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify2fa(Request $request)
    {
        $request->validate([
            'one_time_password' => 'required|numeric'
        ]);

        $userId = $request->session()->get('2fa:user:id');
        
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::findOrFail($userId);

        $google2fa = new Google2FA();
        $secret = decrypt($user->google2fa_secret);
        
        $valid = $google2fa->verifyKey($secret, $request->one_time_password);

        if ($valid) {
            // Log in the user
            auth()->login($user);
            
            // Clear session
            $request->session()->forget('2fa:user:id');
            
            return redirect()->intended($this->redirectPath());
        }

        throw ValidationException::withMessages([
            'one_time_password' => 'Invalid OTP code.'
        ]);
    }
}
