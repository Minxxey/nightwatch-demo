<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;

class LogCandybarDeletionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected User $user;
    protected string $candybarName;

    public function __construct(User $user, string $candybarName)
    {
        $this->user = $user;
        $this->candybarName = $candybarName;
    }

    public function handle(): void
    {
        Log::info("Candybar '{$this->candybarName}' was deleted by user '{$this->user->name}' (ID: {$this->user->id}).");
    }
}
