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

    public function __construct(int $testobjectId, string $url)
    {
        $this->testobjectId = $testobjectId;
        $this->url = $url;
    }

    public function handle(): void
    {
        $testobject = Testobject::find($this->testobjectId);
        if (!$testobject) {
            return;
        }

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
        }

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $baseDomain = parse_url($testobject->url, PHP_URL_HOST);

        foreach ($dom->getElementsByTagName('a') as $a) {
            $href = $a->getAttribute('href');
            if (!$href) {
                continue;
            }
            $abs = CrawlerUtility::makeAbsolute($href, $this->url);
            if (!$abs) {
                continue;
            }
            $parsed = parse_url($abs);
            if (($parsed['host'] ?? '') === $baseDomain) {
                if (
                    !Testrun::where('testobject_id', $testobject->id)
                        ->where('url', $abs)
                        ->exists()
                ) {
                    $path = 'crawler_status.json';
                    if (Storage::exists($path)) {
                        $status = json_decode(Storage::get($path), true);
                        $status['total'] = ($status['total'] ?? 0) + 1;
                        Storage::put($path, json_encode($status));
                    }

                    self::dispatch($testobject->id, $abs);
                }
            }
        }

        $testrun = new Testrun();
        $testrun->testobject_id = $testobject->id;
        $testrun->url = $this->url;
        $testrun->name = $this->url;
        $testrun->save();

        $instance = new Testinstance();
        $instance->testrun_id = $testrun->id;
        $instance->save();
        $instance->fetch();

        $path = 'crawler_status.json';
        if (Storage::exists($path)) {
            $status = json_decode(Storage::get($path), true);
            $status['completed'] = ($status['completed'] ?? 0) + 1;
            Storage::put($path, json_encode($status));
        }
    }
}
