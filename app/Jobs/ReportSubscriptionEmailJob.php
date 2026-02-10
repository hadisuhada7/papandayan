<?php

namespace App\Jobs;

use App\Models\EmailConfig;
use App\Models\LogEmailSender;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReportSubscriptionEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $logId)
    {
    }

    public function middleware(): array
    {
        return [new RateLimited('subscription-emails')];
    }

    public function handle(EmailService $emailService): void
    {
        $log = LogEmailSender::find($this->logId);

        if (! $log || $log->status === 'sent') {
            return;
        }

        $emailService->sendLoggedEmail($log, EmailConfig::TYPE_NOTIFICATION);
    }
}
