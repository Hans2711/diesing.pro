<?php

namespace App\Console\Commands;

use App\Models\Testobject;
use App\Models\Diffstore;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Psr\Http\Message\UriInterface;

class GenerateSitemap extends Command
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
        $depath = public_path("sitemap.de.xml");
        $enpath = public_path("sitemap.en.xml");

        SitemapGenerator::create("https://www.diesing.pro")
            ->shouldCrawl(function (UriInterface $url) {
                return strpos($url->getPath(), '/en') === false;
            })
            ->writeToFile($depath);

        SitemapGenerator::create("https://www.diesing.pro/en")
            ->shouldCrawl(function (UriInterface $url) {
                return strpos($url->getPath(), '/de') === false;
            })
            ->writeToFile($enpath);

    }
}
