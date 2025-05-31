<?php

namespace App\Jobs;

use App\Models\Testrun;
use App\Models\Testinstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class FetchTestrunJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $testrunId;

    public function __construct(string $testrunId)
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

        $objectId = $testrun->testobject_id;

        $completed = Cache::increment("fetch-completed-{$objectId}");
        $total = Cache::get("fetch-total-{$objectId}");

        if ($total !== null && $completed >= $total) {
            Cache::forget("fetch-completed-{$objectId}");
            Cache::forget("fetch-total-{$objectId}");
        }
    }
}
