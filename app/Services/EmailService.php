<?php

namespace App\Services;

use App\Mail\AutoResponseCustomerMail;
use App\Mail\NotificationAdminMail;
use App\Mail\ReportSubscriptionNotificationMail;
use App\Mail\ReportSubscriptionUnsubscribedMail;
use App\Models\EmailConfig;
use App\Models\LogEmailSender;
use App\Models\Question;
use App\Models\ReportSubscriber;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendAutoResponseCustomer(Question $question, ?Ticket $ticket = null): void
    {
        $mail = new AutoResponseCustomerMail($question, $ticket);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_TICKET);
        $mailer = $this->resolveMailer($activeConfig);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $this->sendWithLog(
            $mail,
            $question->email,
            $question,
            $ticket,
            'auto-response-customer',
            $mailer,
            $senderEmail
        );
    }

    public function sendNotificationAdmin(Question $question, ?Ticket $ticket = null): void
    {
        $mail = new NotificationAdminMail($question, $ticket);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_TICKET);
        $mailer = $this->resolveMailer($activeConfig);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $adminAddress = config('mail.admin.address', config('mail.from.address'));
        $adminName = config('mail.admin.name', 'Admin');

        $this->sendWithLog(
            $mail,
            $adminAddress,
            $question,
            $ticket,
            'notification-admin',
            $mailer,
            $senderEmail
        );
    }

    public function sendReportSubscriptionNotification(ReportSubscriber $subscriber, array $payload): void
    {
        $mail = new ReportSubscriptionNotificationMail($payload, $subscriber);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_NOTIFICATION);
        $mailer = $this->resolveMailer($activeConfig);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $this->sendWithLog(
            $mail,
            $subscriber->email,
            null,
            null,
            'subscription-report-notification',
            $mailer,
            $senderEmail
        );
    }

    public function sendReportSubscriptionUnsubscribed(ReportSubscriber $subscriber): void
    {
        $mail = new ReportSubscriptionUnsubscribedMail($subscriber);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_NOTIFICATION);
        $mailer = $this->resolveMailer($activeConfig);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $this->sendWithLog(
            $mail,
            $subscriber->email,
            null,
            null,
            'subscription-unsubscribed',
            $mailer,
            $senderEmail
        );
    }

    public function queueReportSubscriptionNotification(ReportSubscriber $subscriber, array $payload): void
    {
        $mail = new ReportSubscriptionNotificationMail($payload, $subscriber);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_NOTIFICATION);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $this->logMail(
            $mail,
            $subscriber->email,
            null,
            null,
            'subscription-report-notification',
            $senderEmail,
            'queued'
        );
    }

    public function queueReportSubscriptionUnsubscribed(ReportSubscriber $subscriber): void
    {
        $mail = new ReportSubscriptionUnsubscribedMail($subscriber);
        $activeConfig = $this->applySender($mail, EmailConfig::TYPE_NOTIFICATION);
        [$senderEmail] = $this->resolveSender($activeConfig);

        $this->logMail(
            $mail,
            $subscriber->email,
            null,
            null,
            'subscription-unsubscribed',
            $senderEmail,
            'queued'
        );
    }

    public function sendLoggedEmail(LogEmailSender $log, string $type): void
    {
        $activeConfig = EmailConfig::where('is_active', true)
            ->where('type', $type)
            ->first();

        if ($activeConfig) {
            $this->applyMailerConfig($activeConfig);
        }

        $mailer = $this->resolveMailer($activeConfig);
        [$defaultSenderEmail, $defaultSenderName] = $this->resolveSender($activeConfig);
        $senderEmail = $log->sender_email ?: $defaultSenderEmail;
        $senderName = $defaultSenderName;

        if (!empty($senderEmail) && empty($log->sender_email)) {
            $log->update(['sender_email' => $senderEmail]);
        }

        if ($log->status === 'sent') {
            return;
        }

        if ($log->status !== 'sending') {
            $updated = LogEmailSender::where('id', $log->id)
                ->whereIn('status', ['queued', 'failed'])
                ->update([
                    'status' => 'sending',
                    'error_message' => null,
                ]);

            if ($updated === 0) {
                return;
            }

            $log->refresh();
        }

        if (empty($log->body)) {
            $log->update([
                'status' => 'failed',
                'error_message' => 'Email body kosong.',
                'fail_interval' => ($log->fail_interval ?? 0) + 1,
            ]);
            return;
        }

        try {
            Mail::mailer($mailer)->html($log->body, function ($message) use ($log, $senderEmail, $senderName) {
                $message->to($log->recipient_email);
                if (!empty($senderEmail)) {
                    $message->from($senderEmail, $senderName);
                }
                $message->subject($log->subject);
            });

            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
                'error_message' => null,
            ]);
        } catch (\Throwable $exception) {
            $log->update([
                'status' => 'failed',
                'error_message' => $this->formatExceptionMessage($exception),
                'fail_interval' => ($log->fail_interval ?? 0) + 1,
            ]);
            report($exception);
            throw $exception;
        }
    }

    protected function applySender($mail, string $type): ?EmailConfig
    {
        $activeConfig = EmailConfig::where('is_active', true)
            ->where('type', $type)
            ->first();

        if ($activeConfig) {
            $this->applyMailerConfig($activeConfig);
            $mail->from($activeConfig->from_address, $activeConfig->from_name);
        }

        return $activeConfig;
    }

    protected function applyMailerConfig(EmailConfig $config): void
    {
        $scheme = null;
        if ($config->encryption) {
            $scheme = strtolower($config->encryption) === 'ssl' ? 'smtps' : 'smtp';
        }

        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => $config->host,
            'mail.mailers.smtp.port' => $config->port,
            'mail.mailers.smtp.username' => $config->username,
            'mail.mailers.smtp.password' => $config->password,
            'mail.mailers.smtp.scheme' => $scheme,
        ]);
    }

    protected function resolveMailer(?EmailConfig $activeConfig): string
    {
        return $activeConfig ? 'smtp' : config('mail.default', 'log');
    }

    protected function sendWithLog($mail, string $recipientEmail, ?Question $question, ?Ticket $ticket, string $template, string $mailer, ?string $senderEmail = null): void
    {
        $log = $this->logMail($mail, $recipientEmail, $question, $ticket, $template, $senderEmail, 'queued');

        try {
            $log->update(['status' => 'sending']);
            Mail::mailer($mailer)->to($recipientEmail)->send($mail);
            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            $log->update([
                'status' => 'failed',
                'error_message' => $this->formatExceptionMessage($exception),
                'fail_interval' => ($log->fail_interval ?? 0) + 1,
            ]);
            report($exception);
            throw $exception;
        }
    }

    protected function logMail($mail, string $recipientEmail, ?Question $question, ?Ticket $ticket, string $template, ?string $senderEmail, string $status): LogEmailSender
    {
        $subject = $mail->envelope()->subject ?? 'Notification';
        $body = $mail->render();

        return LogEmailSender::create([
            'question_id' => $question?->id,
            'ticket_id' => $ticket?->id,
            'recipient_email' => $recipientEmail,
            'sender_email' => $senderEmail,
            'subject' => $subject,
            'template' => $template,
            'body' => $body,
            'status' => $status,
        ]);
    }

    protected function resolveSender(?EmailConfig $activeConfig): array
    {
        $address = $activeConfig?->from_address ?? config('mail.from.address');
        $name = $activeConfig?->from_name ?? config('mail.from.name');

        return [$address, $name];
    }

    protected function formatExceptionMessage(\Throwable $exception): string
    {
        $message = sprintf(
            "[%s] %s\nCode: %s\nFile: %s:%s",
            $exception::class,
            $exception->getMessage(),
            $exception->getCode(),
            $exception->getFile(),
            $exception->getLine()
        );

        $previous = $exception->getPrevious();
        if ($previous) {
            $message .= sprintf(
                "\nPrevious: [%s] %s\nPrev File: %s:%s",
                $previous::class,
                $previous->getMessage(),
                $previous->getFile(),
                $previous->getLine()
            );
        }

        return $message;
    }
}
