<?php

namespace App\Jobs;

use App\Models\Testobject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class GenerateBulkDiffJob implements ShouldQueue
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

        $html = '';
        foreach ($testobject->testruns as $run) {
            if ($run->testinstances->count() >= 2) {
                $a = $run->testinstances[0];
                $b = $run->testinstances[1];
                $html .= '<h3>' . $run->name . '</h3>';
                $html .= $a->diff($b, 'Inline');
            }
        }

        Cache::put("bulk-diff-content-{$this->testobjectId}", $html, now()->addMinutes(5));
        Cache::put("bulk-diff-completed-{$this->testobjectId}", true, now()->addMinutes(5));
    }
}
