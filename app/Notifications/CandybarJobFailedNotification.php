<?php

namespace App\Notifications;

use App\Models\Candybar;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

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


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Candybar konnte nicht verarbeitet werden")
            ->greeting("Hallo!")
            ->line("Beim Verarbeiten der Candybar '" . ($this->candybarName ?? '[unbekannt]') . "' ist ein Fehler aufgetreten.")
            ->line("Fehler: {$this->error}")
            ->line('Bitte behebe das Problem oder informiere das Team.');
    }
}
