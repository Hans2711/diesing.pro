<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class TransportScheduler extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Schedule $schedule): void
    {
        //
        $schedule->command("app:update-stations")->cron("*/10 * * * *");
        $schedule->command("php artisan scout:import \"App\Models\Station\"")->cron("*/10 * * * *");
    }
}
