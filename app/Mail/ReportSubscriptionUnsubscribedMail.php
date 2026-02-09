<?php

namespace App\Mail;

use App\Models\ReportSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Symfony\Component\Mime\Part\DataPart;

class ReportSubscriptionUnsubscribedMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $logoCid;
    public string $logoSrc;
    protected string $logoPath;

    /**
     * Create a new message instance.
     */
    public function __construct(public ReportSubscriber $subscriber)
    {
        $this->logoPath = public_path('images/logo/logo6.png');
        $this->logoCid = 'papandayan-logo-'.Str::uuid().'@papandayan';

        $this->logoSrc = 'https://www.test.papandayan.co.id/images/logo/logo6.png';

        $this->withSymfonyMessage(function ($message) {
            if (! is_file($this->logoPath)) {
                return;
            }

            $part = DataPart::fromPath($this->logoPath, 'papandayan-logo.png', 'image/png');
            $part->asInline();
            $part->setContentId($this->logoCid);

            $message->addPart($part);
        });
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'We are Sorry to find you are no longer Interested in our Mailing List',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_unsubscribed',
            with: [
                'subscriber' => $this->subscriber,
                'resubscribeUrl' => route('front.subscription.resubscribe', $this->subscriber->token),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
