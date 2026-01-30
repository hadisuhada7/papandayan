<?php

namespace App\Http\Controllers;

use App\Models\LogEmailSender;
use Illuminate\View\View;

class LogEmailSenderController extends Controller
{
    public function index(): View
    {
        $logs = LogEmailSender::with(['question', 'ticket'])->latest('id')->paginate(10);

        return view('admin.email-logs.index', compact('logs'));
    }

    public function show(LogEmailSender $email_log): View
    {
        $email_log->load(['question', 'ticket']);
        $bodyPreview = $email_log->body;

        if ($bodyPreview) {
            $bodyPreview = preg_replace('/cid:[^"\']+/', asset('images/logo/favicon.png'), $bodyPreview);
        }

        return view('admin.email-logs.show', [
            'log' => $email_log,
            'bodyPreview' => $bodyPreview,
        ]);
    }
}
