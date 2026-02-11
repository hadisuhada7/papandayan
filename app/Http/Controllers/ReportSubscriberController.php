<?php

namespace App\Http\Controllers;

use App\Models\ReportSubscriber;

class ReportSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscribers = ReportSubscriber::orderByDesc('subscribed_at')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.report-subscribers.index', compact('subscribers'));
    }
}
