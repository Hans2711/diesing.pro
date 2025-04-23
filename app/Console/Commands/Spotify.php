<?php

namespace App\Console\Commands;

use App\Models\Testobject;
use App\Models\Diffstore;
use App\Utilities\SpotifyUtility;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class spotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "work:spotify";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Works with Spotify API";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $spotifyUtility = new SpotifyUtility();

        if (!$spotifyUtility->isAuthenticated()) {
            if (!$spotifyUtility->authenticate()) {
                $this->error("Spotify authentication failed.");
                return;
            }
        }

        $recentlyPlayedTracks = $spotifyUtility->getRecentlyPlayedTracks();
        dd($recentlyPlayedTracks);
    }
}

