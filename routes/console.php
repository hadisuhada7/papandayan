<?php

use App\Jobs\TicketingJob;
use App\Models\LogEmailSender;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');


// Schedule::call(new TicketingJob())->everyMinute();
Schedule::call(function () {
    $now = now();
    $startTime = $now->copy()->setTime(6, 30);
    $endTime = $now->copy()->setTime(17, 0);

    if (! $now->between($startTime, $endTime)) {
        return;
    }

    $emails = LogEmailSender::query()
        ->whereIn('status', ['queued', 'failed'])
        ->where('fail_interval', '<', 5)
        ->orderBy('created_at')
        ->take(5)
        ->get();

    foreach ($emails as $email) {
        try {
            TicketingJob::dispatch($email->question_id);
        } catch (\Throwable $exception) {
            $email->update([
                'status' => 'failed',
                'fail_interval' => $email->fail_interval + 1,
                'error_message' => $exception->getMessage(),
            ]);
        }
    }
})->everyMinute();
