<?php
namespace App\Jobs;

use App\Models\Testobject;
use App\Models\Testrun;
use App\Models\Testinstance;
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
