<?php

namespace App\Jobs;

use App\Models\Candybar;
use App\Models\User;
use App\Notifications\CandybarJobFailedNotification;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NotifyAdminAboutCandybarFailureJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $candybarName;
    protected string $error;

    public int $tries = 3;

    public function __construct(string $candybarName, string $error)
    {
        $this->candybarName = $candybarName;
        $this->error = $error;
    }

    public function handle(): void
    {
        $admin = User::where('email', 'admin@byte5.de')->first();

        if ($this->attempts() <= 3) {
            $admin->notify(new CandybarJobFailedNotification(
                $this->candybarName,
                $this->error
            ));
        }
    }
}
