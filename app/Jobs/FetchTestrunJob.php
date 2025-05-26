<?php

namespace App\Jobs;

use App\Models\Testrun;
use App\Models\Testinstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class FetchTestrunJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $testrunId;

    public function __construct(int $testrunId)
    {
        $this->testrunId = $testrunId;
    }

    public function handle(): void
    {
        $testrun = Testrun::find($this->testrunId);
        if (!$testrun) {
            return;
        }

        $instance = new Testinstance();
        $instance->testrun_id = $testrun->id;
        $instance->save();
        $instance->fetch();

        $path = "testobject-{$testrun->testobject_id}-fetch.json";
        $status = ['total' => 0, 'completed' => 0];
        if (Storage::exists($path)) {
            $status = json_decode(Storage::get($path), true) ?: $status;
        }
        $status['completed'] = ($status['completed'] ?? 0) + 1;

        if ($status['completed'] >= $status['total']) {
            Storage::delete($path);
        }
        Storage::put($path, json_encode($status));
    }
}
