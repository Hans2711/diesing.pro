<?php

namespace App\Jobs;

use App\Models\Testrun;
use App\Models\Testinstance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class FetchTestrunJob implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $testrunId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $testrunId)
    {
        $this->testrunId = $testrunId;
    }

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->testrunId;
    }

    /**
     * Optionally set how long the job should be unique (in seconds).
     * Laravel will not allow another job with the same ID during this time.
     */
    public function uniqueFor(): int
    {
        return 60; // 1 minute, adjust as needed
    }

    /**
     * Execute the job.
     */
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

