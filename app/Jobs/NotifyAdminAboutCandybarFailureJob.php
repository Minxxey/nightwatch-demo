<?php

namespace App\Jobs;

use App\Mail\CandybarJobFailedMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        Mail::to($admin)->send(new CandybarJobFailedMail($this->candybarName, $this->error, 'Adding a new Candybar failed'));

    }
}
