<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandybarJobFailedMail extends Mailable
{
    use Queueable, SerializesModels;

    protected string $candybarName;

    protected string $error;

    protected string $emailSubject;

    /**
     * Create a new message instance.
     */
    public function __construct(string $candybarName, string $error, string $subject)
    {
        $this->candybarName = $candybarName;
        $this->error = $error;
        $this->emailSubject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.candybar-failed',
            with: [
                'candybarName' => $this->candybarName,
                'error' => $this->error,
                'subject' => $this->emailSubject,
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
