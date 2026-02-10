<?php

use App\Jobs\TicketingJob;
use App\Jobs\ReportSubscriptionEmailJob;
// use App\Models\LogEmailSender;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');


// Schedule::call(new TicketingJob())->everyMinute();
Schedule::call(function () {
    $now = now();
    $startTime = $now->copy()->setTime(6, 30);
    $endTime = $now->copy()->setTime(22, 0);

    // $endTime = $now->copy()->setTime(17, 0);

    if (! $now->between($startTime, $endTime)) {
        return;
    }

    $stuckThreshold = now()->subMinutes(10);
    $stuckLogs = DB::table('log_email_senders')
        ->where('status', 'sending')
        ->where('updated_at', '<', $stuckThreshold)
        ->get();

    foreach ($stuckLogs as $stuckLog) {
        $updatedAt = $stuckLog->updated_at ? Carbon::parse($stuckLog->updated_at) : $now;
        $timeoutMinutes = $updatedAt->diffInMinutes($now);

        $detailMessage = sprintf(
            "Auto retry: sending timeout after %d minutes.\nPossible causes: queue worker not running, rate limiter delaying jobs, or SMTP connection timeout.\nLog ID: %d\nTemplate: %s\nRecipient: %s\nCreated At: %s\nLast Updated: %s",
            $timeoutMinutes,
            $stuckLog->id,
            $stuckLog->template ?? '-',
            $stuckLog->recipient_email ?? '-',
            $stuckLog->created_at ?? '-',
            $stuckLog->updated_at ?? '-'
        );

        DB::table('log_email_senders')->where('id', $stuckLog->id)->update([
            'status' => 'failed',
            'fail_interval' => ($stuckLog->fail_interval ?? 0) + 1,
            'error_message' => $detailMessage,
            'updated_at' => now(),
        ]);
    }

    $emails = DB::table('log_email_senders')
        ->whereIn('status', ['queued', 'failed'])
        ->where('fail_interval', '<', 5)
        ->orderBy('created_at')
        ->take(5)
        ->get();

    $delayInSeconds = 0;

    foreach ($emails as $email) {
        try {
            if (in_array($email->template, ['subscription-report-notification', 'subscription-unsubscribed'], true)) {
                $updated = DB::table('log_email_senders')
                    ->where('id', $email->id)
                    ->whereIn('status', ['queued', 'failed'])
                    ->update([
                        'status' => 'sending',
                        'error_message' => null,
                    ]);

                if ($updated === 0) {
                    continue;
                }

                ReportSubscriptionEmailJob::dispatch($email->id)
                    ->onQueue('emails')
                    ->delay(now()->addSeconds($delayInSeconds));
                $delayInSeconds += 2;
                continue;
            }

            if (!empty($email->question_id)) {
                TicketingJob::dispatch($email->question_id)
                    ->onQueue('tickets')
                    ->delay(now()->addSeconds($delayInSeconds));
                $delayInSeconds += 2;
            }
        } catch (\Throwable $exception) {
            DB::table('log_email_senders')->where('id', $email->id)->update([
                'status' => 'failed',
                'fail_interval' => $email->fail_interval + 1,
                'error_message' => $exception->getMessage(),
            ]);
        }
    }
})->everyMinute();
