<?php

namespace App\Notifications;

use App\Mail\CandybarJobFailedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandybarJobFailedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $candybarName;

    protected string $error;

    public function __construct(string $candybarName, string $error)
    {
        $this->candybarName = $candybarName;
        $this->error = $error;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): CandybarJobFailedMail
    {
        return new CandybarJobFailedMail($this->candybarName, $this->error, 'Candybar creation failed');
    }
}
