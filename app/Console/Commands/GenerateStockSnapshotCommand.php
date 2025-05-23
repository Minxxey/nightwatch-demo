<?php

namespace App\Console\Commands;

use App\Mail\DailyStockSnapshot;
use App\Models\Candybar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Command\Command as CommandAlias;

class GenerateStockSnapshotCommand extends Command
{
    protected $signature = 'candybar:daily-stock-snapshot';

    protected $description = 'Send daily stock snapshot of all candybars to admin';

    public function handle(): int
    {
        $allCandybars = Candybar::all();

        if ($allCandybars->isEmpty()) {
            return CommandAlias::SUCCESS;
        }

        $to = 'lstaudt@byte5.de';

        Mail::to($to)->send(new DailyStockSnapshot($allCandybars->toArray()));

        return CommandAlias::SUCCESS;
    }
}
