<?php

namespace App\Console\Commands;

use App\Models\Testobject;
use App\Models\Diffstore;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class CleanTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "generate:sitemap";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Generate Sitemap";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = public_path("sitemap.xml");
        SitemapGenerator::create("https://www.diesing.pro")->writeToFile($path);
    }
}
