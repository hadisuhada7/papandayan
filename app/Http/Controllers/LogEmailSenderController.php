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

    public function show(LogEmailSender $logEmailSender): View
    {
        return view('admin.email-logs.show', ['log' => $logEmailSender]);
    }
}