<?php

namespace App\Services;

use App\Mail\AutoResponseCustomerMail;
use App\Mail\NotificationAdminMail;
use App\Models\EmailConfig;
use App\Models\LogEmailSender;
use App\Models\Question;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendAutoResponseCustomer(Question $question, ?Ticket $ticket = null): void
    {
        $mail = new AutoResponseCustomerMail($question, $ticket);
        $activeConfig = $this->applySender($mail);
        $mailer = $this->resolveMailer($activeConfig);

        $this->sendWithLog(
            $mail,
            $question->email,
            $question,
            $ticket,
            'auto-response-customer',
            $mailer
        );
    }

    public function sendNotificationAdmin(Question $question, ?Ticket $ticket = null): void
    {
        $mail = new NotificationAdminMail($question, $ticket);
        $activeConfig = $this->applySender($mail);
        $mailer = $this->resolveMailer($activeConfig);

        $adminAddress = config('mail.admin.address', config('mail.from.address'));
        $adminName = config('mail.admin.name', 'Admin');

        $this->sendWithLog(
            $mail,
            $adminAddress,
            $question,
            $ticket,
            'notification-admin',
            $mailer
        );
    }

    protected function applySender($mail): ?EmailConfig
    {
        $activeConfig = EmailConfig::where('is_active', true)->first();

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

    protected function sendWithLog($mail, string $recipientEmail, Question $question, ?Ticket $ticket, string $template, string $mailer): void
    {
        $subject = $mail->envelope()->subject ?? 'Notification';
        $body = $mail->render();
        $log = LogEmailSender::create([
            'question_id' => $question->id,
            'ticket_id' => $ticket?->id,
            'recipient_email' => $recipientEmail,
            'subject' => $subject,
            'template' => $template,
            'body' => $body,
            'status' => 'queued',
        ]);

        try {
            Mail::mailer($mailer)->to($recipientEmail)->send($mail);
            $log->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
        } catch (\Throwable $exception) {
            $log->update([
                'status' => 'failed',
                'error_message' => $exception->getMessage(),
            ]);
            report($exception);
            throw $exception;
        }
    }
}
