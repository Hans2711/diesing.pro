<?php

namespace App\Jobs;

use App\Models\Testobject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class DeleteTestobjectDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $testobjectId;

    public function __construct(int $testobjectId)
    {
        $this->testobjectId = $testobjectId;
    }

    public function handle(): void
    {
        $testobject = Testobject::find($this->testobjectId);
        if (! $testobject) {
            return;
        }

        foreach ($testobject->testruns as $run) {
            foreach ($run->testinstances as $instance) {
                $instance->delete();
            }
            $run->delete();
        }

        Cache::put("delete-all-completed-{$this->testobjectId}", true, now()->addMinutes(5));
    }
}
