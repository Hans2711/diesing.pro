<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use SimpleXMLElement;

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

        $deUrls = [
            '/' => 'home',
            '/de' => 'home',
            '/de/impressum' => 'imprint',
            '/de/datenschutz' => 'data-protection',
            '/de/portfolio' => 'portfolio',
            '/de/teams' => 'random-teams',
            '/de/kontakt' => 'contact',
            '/de/tester' => 'tester',
            '/de/lebenslauf' => 'cv',
            '/de/echtzeit-teilen' => 'rt-share',
        ];

        $enUrls = [
            '/en' => 'home',
            '/en/imprint' => 'imprint',
            '/en/data-protection' => 'data-protection',
            '/en/portfolio' => 'portfolio',
            '/en/teams' => 'random-teams',
            '/en/contact' => 'contact',
            '/en/tester' => 'tester',
            '/en/cv' => 'cv',
            '/en/realtime-share' => 'rt-share',
        ];

        $this->writeSitemap($deUrls, 'de', $depath);
        $this->writeSitemap($enUrls, 'en', $enpath);

    }

    private function writeSitemap(array $urls, string $locale, string $path): void
    {
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset></urlset>');
        $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($urls as $fragment => $key) {
            $url = $xml->addChild('url');
            $url->addChild('loc', 'https://www.diesing.pro' . $fragment);
            $url->addChild('description', __('descriptions.' . $key, [], $locale));
        }

        $xml->asXML($path);
    }
}
