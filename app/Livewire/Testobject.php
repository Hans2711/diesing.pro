<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testrun;
use App\Utilities\CrawlerUtility;
use App\Jobs\CrawlTestRunJob;
use App\Jobs\FetchTestrunJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class Testobject extends Component
{
    public $testobject;
    public $deleteAfter;
    public $deleteAfterOptions;
    public $bulkDiffContent;
    public $crawlStatus;
    public $fetchStatus;
    public $sitemapsInput;

    public function mount()
    {
        $this->deleteAfterOptions = [
            "86400" => __("text.1-day"),
            "604800" => __("text.7-days"),
            "2629800" => __("text.1-month"),
            "0" => __("text.never"),
        ];

        $this->updateStatus();
        $this->updateFetchStatus();
        $this->sitemapsInput = implode(', ', $this->testobject->sitemaps ?? []);
    }

    public function updateDeleteAfter($deleteAfter)
    {
        $this->deleteAfter = $deleteAfter;
        $this->testobject->delete_after = $deleteAfter;
        $this->testobject->save();
    }

    public function createRun()
    {
        $testrun = new Testrun();
        $testrun->testobject_id = $this->testobject->id;
        $testrun->save();
        session()->flash("message", "Testrun created successfully.");
    }

    public function updateStatus()
    {
        $path = 'crawler_status.json';
        if (Storage::exists($path)) {
            $this->crawlStatus = json_decode(Storage::get($path), true);
        } else {
            $this->crawlStatus = null;
        }
    }

    public function updateFetchStatus()
    {
        $objectId = $this->testobject->id;
        $total = Cache::get("fetch-total-{$objectId}");
        $completed = Cache::get("fetch-completed-{$objectId}", 0);

        if ($total !== null) {
            $this->fetchStatus = [
                'total' => $total,
                'completed' => $completed,
            ];
        } else {
            $this->fetchStatus = null;
        }
    }

    public function deleteRun($id)
    {
        foreach ($this->testobject->testruns as $a) {
            if ($a->id == $id) {
                foreach ($a->testinstances as $b) {
                    $b->delete();
                }
            }
        }

        Testrun::destroy($id);
        $this->testobject = \App\Models\Testobject::find($this->testobject->id);
        session()->flash("message", "Testrun deleted successfully.");
    }

    public function crawlDomain()
    {
        Storage::put('crawler_status.json', json_encode([
            'total' => 1,
            'completed' => 0,
        ]));

        CrawlTestRunJob::dispatch((int)$this->testobject->id, $this->testobject->url);

        $this->testobject->refresh();
        session()->flash('message', __('text.crawl_started'));
    }

    public function fetchAll()
    {
        $dispatchedCount = 0;

        foreach ($this->testobject->testruns as $run) {
            $cacheKey = "fetch-dispatched-{$run->id}";

            // Only dispatch if not already dispatched recently
            if (!Cache::has($cacheKey)) {
                FetchTestrunJob::dispatch($run->id);
                Cache::put($cacheKey, true, now()->addMinute());
                $dispatchedCount++;
            }
        }

        // Track the total number of dispatched jobs in cache
        if ($dispatchedCount > 0) {
            $objectId = $this->testobject->id;
            Cache::put("fetch-total-{$objectId}", $dispatchedCount);
            Cache::forget("fetch-completed-{$objectId}");
            Cache::set("fetch-completed-{$objectId}", 0);

            $this->updateFetchStatus();
            session()->flash('message', __('text.fetch_started'));
        } else {
            session()->flash('message', __('text.fetch_already_dispatched'));
        }
    }

    public function deleteAll() {
        foreach ($this->testobject->testruns as $run) {
            foreach ($run->testinstances as $instance) {
                $instance->delete();
            }
            $run->delete();
        }
        $this->testobject->refresh();
        session()->flash("message", __("text.all_deleted"));
    }

    public function bulkDiff()
    {
        $html = "";
        foreach ($this->testobject->testruns as $run) {
            if ($run->testinstances->count() >= 2) {
                $a = $run->testinstances[0];
                $b = $run->testinstances[1];
                $html .= "<h3>" . $run->name . "</h3>";
                $html .= $a->diff($b, "Inline");
            }
        }
        $this->bulkDiffContent = $html;
    }

    public function saveSitemaps()
    {
        $sitemaps = array_filter(array_map('trim', explode(',', $this->sitemapsInput)));
        $this->testobject->sitemaps = $sitemaps;
        $this->testobject->save();
        $this->sitemapsInput = implode(', ', $sitemaps);
        session()->flash('message', __('text.saved'));
    }

    public function runSitemaps()
    {
        $this->saveSitemaps();

        $links = CrawlerUtility::linksFromSitemaps($this->testobject->sitemaps);
        foreach ($links as $link) {
            $testrun = Testrun::where('testobject_id', $this->testobject->id)
                ->where('url', $link)
                ->first();

            if (!$testrun) {
                $testrun = new Testrun();
                $testrun->testobject_id = $this->testobject->id;
                $testrun->url = $link;
                $testrun->name = $link;
                $testrun->save();
            }
        }

        $this->testobject->refresh();
        session()->flash('message', __('text.crawl_completed'));
    }

    public function render()
    {
        return view("livewire.testobject");
    }
}
