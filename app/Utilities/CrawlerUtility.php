<?php
namespace App\Utilities;

use App\Models\Testobject;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\UriResolver;
use DOMDocument;

class CrawlerUtility
{
    public static function crawl(Testobject $testobject): array
    {
        $base = parse_url($testobject->url);
        $domain = $base['host'] ?? '';
        $visited = [];
        $links = [];
        $queue = [$testobject->url];
        $client = new Client(['http_errors' => false]);

        while ($queue) {
            $url = array_shift($queue);
            if (isset($visited[$url])) {
                continue;
            }
            $visited[$url] = true;
            try {
                $response = $client->get($url);
                $html = (string) $response->getBody();
            } catch (\Exception $e) {
                continue;
            }

            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            foreach ($dom->getElementsByTagName('a') as $a) {
                $href = $a->getAttribute('href');
                if (!$href) {
                    continue;
                }
                $abs = self::makeAbsolute($href, $url);
                if (!$abs) {
                    continue;
                }
                $parsed = parse_url($abs);
                if (($parsed['host'] ?? '') === $domain) {
                    if (!isset($visited[$abs])) {
                        $queue[] = $abs;
                    }
                    if (!in_array($abs, $links)) {
                        $links[] = $abs;
                    }
                }
            }
        }
        return $links;
    }

    public static function makeAbsolute(string $href, string $base): ?string
    {
        try {
            $baseUri = new Uri($base);
            $hrefUri = new Uri($href);
            $absUri = UriResolver::resolve($baseUri, $hrefUri);
            return (string) $absUri;
        } catch (\Exception $e) {
            return null;
        }
    }
}
