<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleProvider extends ServiceProvider
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
        $schedule->command("tester:clean")->cron("0 4,16 * * *");
        $schedule->command("generate:sitemap")->cron("0 5 * * *");
        $schedule->command("clean:file-references")->cron("10 5 * * *");
        $schedule->command("work:redirect-hits")->cron("*/5 * * * *");
    }
}
