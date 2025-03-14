<?php

namespace App\Console\Commands;

use App\Models\RedirectHit;
use App\Utilities\IpGeoUtility;
use Illuminate\Console\Command;

class WorkRedirectHits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "work:redirect-hits";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Work Redirect Hits";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        RedirectHit::all()->each(function ($hit) {
            if ($hit->created_at->diffInDays(now()) > 178) {
                $hit->delete();
                return;
            }

            if ($hit->created_at->diffInDays(now()) < 30 && empty($hit->geo)) {
                $hit->geo = json_encode(IpGeoUtility::getGeo($hit->ip), JSON_UNESCAPED_UNICODE);
                $hit->save();
            }
        });
    }
}

