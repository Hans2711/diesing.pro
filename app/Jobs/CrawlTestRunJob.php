<?php
namespace App\Jobs;

use App\Models\Testobject;
use App\Models\Testrun;
use App\Models\Testinstance;
use App\Utilities\CrawlerUtility;
use GuzzleHttp\Client;
use DOMDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CrawlTestRunJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $testobjectId;
    protected string $url;

    /**
     * File‑type extensions that should NOT be crawled.
     * Extend as needed.
     */
    protected const NON_PAGE_EXTS = [
        // Images
        'jpg','jpeg','png','gif','svg','webp','bmp','ico',
        // Documents & archives
        'pdf','doc','docx','xls','xlsx','ppt','pptx','odt','ods','odp',
        'zip','rar','tar','gz','7z','gzip','tgz',
        // Media
        'mp3','wav','ogg','ogv','m4a','flac',
        'mp4','m4v','mkv','mov','avi','webm',
        // Other assets
        'css','js','json','xml','csv','txt','woff','woff2','ttf','eot','otf'
    ];

    public function __construct(int $testobjectId, string $url)
    {
        $this->testobjectId = $testobjectId;
        // Normalise incoming URL: remove fragment identifiers
        $this->url = self::normaliseUrl($url);
    }

    /**
     * Remove fragment identifier ("#…") from URL.
     */
    protected static function normaliseUrl(string $url): string
    {
        return strtok($url, '#');
    }

    /**
     * Decide whether a URL should be crawled based on its extension.
     */
    protected static function isCrawlable(string $url): bool
    {
        $parsed = parse_url($url);
        $path   = $parsed['path'] ?? '';
        $ext    = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // If there is an extension and it's in NON_PAGE_EXTS, skip it
        if ($ext && in_array($ext, self::NON_PAGE_EXTS, true)) {
            return false;
        }

        return true;
    }

    public function handle(): void
    {
        $testobject = Testobject::find($this->testobjectId);
        if (!$testobject) {
            return;
        }

        // Because $this->url is normalised, duplicates differing only by fragment are avoided
        if (
            Testrun::where('testobject_id', $testobject->id)
                ->where('url', $this->url)
                ->exists()
        ) {
            return;
        }

        $client = new Client(['http_errors' => false]);
        $html = '';
        try {
            $response = $client->get($this->url);
            $html = (string) $response->getBody();
        } catch (\Exception $e) {
            // Ignore HTTP errors and continue with what we have (empty HTML)
        }

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $baseDomain = parse_url($testobject->url, PHP_URL_HOST);

        foreach ($dom->getElementsByTagName('a') as $a) {
            $href = $a->getAttribute('href');

            // Skip empty href or in‑page anchors
            if (!$href || $href[0] === '#') {
                continue;
            }

            $abs = CrawlerUtility::makeAbsolute($href, $this->url);
            if (!$abs) {
                continue;
            }

            // Normalise and decide whether to crawl
            $abs = self::normaliseUrl($abs);
            if (!self::isCrawlable($abs)) {
                continue;
            }

            $parsed = parse_url($abs);
            if (($parsed['host'] ?? '') === $baseDomain) {
                // Avoid duplicate crawls for same testobject & URL
                if (
                    !Testrun::where('testobject_id', $testobject->id)
                        ->where('url', $abs)
                        ->exists()
                ) {
                    // Update crawler status (optional metrics)
                    $path = 'crawler_status.json';
                    if (Storage::exists($path)) {
                        $status = json_decode(Storage::get($path), true);
                        $status['total'] = ($status['total'] ?? 0) + 1;
                        Storage::put($path, json_encode($status));
                    }

                    // Dispatch follow‑up crawl job
                    self::dispatch($testobject->id, $abs);
                }
            }
        }

        // Record this run once all links have been enqueued
        $testrun = new Testrun();
        $testrun->testobject_id = $testobject->id;
        $testrun->url = $this->url;
        $testrun->name = $this->url;
        $testrun->save();

        $instance = new Testinstance();
        $instance->testrun_id = $testrun->id;
        $instance->save();
        $instance->fetch();

        // Update crawler completion metrics
        $path = 'crawler_status.json';
        if (Storage::exists($path)) {
            $status = json_decode(Storage::get($path), true);
            $status['completed'] = ($status['completed'] ?? 0) + 1;
            Storage::put($path, json_encode($status));
        }
    }
}
