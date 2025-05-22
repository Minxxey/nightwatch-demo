<?php

namespace App\Console\Commands;

use App\Mail\LowStockAlert;
use App\Models\Candybar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Command\Command as CommandAlias;

class LowStockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'candybar:low-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check wether a candybar is low in stock';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Checking for low stock');

        $lowStockCandybars = Candybar::whereColumn('amount', '<', 'candybarTreshhold')->get();

        if ($lowStockCandybars->isEmpty()) {
            return CommandAlias::SUCCESS;
        }

        $to = 'admin@byte5.de';

        Mail::to($to)->send(new LowStockAlert($lowStockCandybars->toArray()));

        return CommandAlias::SUCCESS;
    }
}
