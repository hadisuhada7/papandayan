<?php

namespace App\Mail;

use App\Models\Question;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AutoResponseCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $logoSrc;

    /**
     * Create a new message instance.
     */
    public function __construct(public Question $question, public ?Ticket $ticket = null)
    {
        // $this->logoSrc = 'cid:...';
        $this->logoSrc = 'https://www.test.papandayan.co.id/images/logo/logo6.png';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $ticketNumber = $this->ticket?->ticket_number ?? 'PIP-XXXXXX';
        return new Envelope(
            subject: "Terima kasih telah menghubungi Papandayan (Tiket {$ticketNumber})",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.auto_response_customer',
            with: [
                'question' => $this->question,
                'ticket' => $this->ticket,
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
