<?php

namespace App\Http\Controllers;

use App\Models\ReportSubscriber;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ReportSubscriptionController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $email = strtolower(trim($validated['email']));

        $subscriber = ReportSubscriber::where('email', $email)->first();

        if ($subscriber && $subscriber->is_active) {
            return $this->subscriptionResponse($request, 'Email sudah terdaftar sebagai subscriber.', false);
        }

        if (!$subscriber) {
            ReportSubscriber::create([
                'email' => $email,
                'token' => (string) Str::uuid(),
                'is_active' => true,
                'subscribed_at' => now(),
            ]);
        } else {
            $subscriber->update([
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]);
        }

        return $this->subscriptionResponse($request, 'Berhasil berlangganan notifikasi laporan.', true);
    }

    public function unsubscribe(string $token, EmailService $emailService): View
    {
        $subscriber = ReportSubscriber::where('token', $token)->first();

        if (!$subscriber) {
            return view('front.subscription-status', [
                'title' => 'Subscription Tidak Ditemukan',
                'message' => 'Token tidak valid atau sudah tidak berlaku.',
                'actionLabel' => 'Kembali ke Beranda',
                'actionUrl' => route('front.index'),
            ]);
        }

        if ($subscriber->is_active) {
            $subscriber->update([
                'is_active' => false,
                'unsubscribed_at' => now(),
            ]);

            try {
                $emailService->queueReportSubscriptionUnsubscribed($subscriber);
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        return view('front.subscription-status', [
            'title' => 'Berhenti Berlangganan',
            'message' => 'Anda telah berhenti berlangganan notifikasi laporan.',
            'actionLabel' => 'Berlangganan Lagi',
            'actionUrl' => route('front.subscription.resubscribe', $subscriber->token),
        ]);
    }

    public function resubscribe(string $token): View
    {
        $subscriber = ReportSubscriber::where('token', $token)->first();

        if (!$subscriber) {
            return view('front.subscription-status', [
                'title' => 'Subscription Tidak Ditemukan',
                'message' => 'Token tidak valid atau sudah tidak berlaku.',
                'actionLabel' => 'Kembali ke Beranda',
                'actionUrl' => route('front.index'),
            ]);
        }

        if (!$subscriber->is_active) {
            $subscriber->update([
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]);
        }

        return view('front.subscription-status', [
            'title' => 'Berlangganan Kembali',
            'message' => 'Terima kasih, email Anda telah aktif kembali.',
            'actionLabel' => 'Lihat Laporan',
            'actionUrl' => route('front.documents'),
        ]);
    }

    private function subscriptionResponse(Request $request, string $message, bool $success): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => $success,
                'message' => $message,
            ], $success ? 200 : 422);
        }

        return redirect()->back()->with('toast', [
            'type' => $success ? 'success' : 'error',
            'message' => $message,
        ]);
    }
}
