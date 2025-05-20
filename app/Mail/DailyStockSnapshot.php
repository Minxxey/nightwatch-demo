<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyStockSnapshot extends Mailable
{
    use Queueable, SerializesModels;

    protected array $candybars;

    public function __construct(array $candybars)
    {
        $this->candybars = $candybars;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Candybar Stock Snapshot',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.stock-snapshot',
            with: [
                'candybars' => $this->candybars,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
