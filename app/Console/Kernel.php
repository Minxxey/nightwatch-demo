<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

class Kernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('candybars:check-stock')->hourly();
    }
}
