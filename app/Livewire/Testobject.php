<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Testrun;
use App\Models\Testinstance;
use App\Utilities\CrawlerUtility;
use App\Jobs\CrawlTestRunJob;
use Illuminate\Support\Facades\Storage;

class Testobject extends Component
{
    public $testobject;
    public $deleteAfter;
    public $deleteAfterOptions;
    public $bulkDiffContent;
    public $crawlStatus;
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
        $this->sitemapsInput = implode("\n", $this->testobject->sitemaps ?? []);
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

        CrawlTestRunJob::dispatch($this->testobject->id, $this->testobject->url);

        $this->testobject->refresh();
        session()->flash('message', __('text.crawl_started'));
    }

    public function fetchAll()
    {
        foreach ($this->testobject->testruns as $run) {
            $instance = new Testinstance();
            $instance->testrun_id = $run->id;
            $instance->save();
            $instance->fetch();
        }
        $this->testobject->refresh();
        session()->flash("message", __("text.fetch_completed"));
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
        $sitemaps = array_filter(array_map('trim', preg_split('/\r?\n/', $this->sitemapsInput)));
        $this->testobject->sitemaps = $sitemaps;
        $this->testobject->save();
        $this->sitemapsInput = implode("\n", $sitemaps);
        session()->flash('message', __('text.saved'));
    }

    public function runSitemaps()
    {
        $this->saveSitemaps();

        $links = CrawlerUtility::linksFromSitemaps($this->testobject->sitemaps);
        foreach ($links as $link) {
            if (!Testrun::where('testobject_id', $this->testobject->id)->where('url', $link)->exists()) {
                $testrun = new Testrun();
                $testrun->testobject_id = $this->testobject->id;
                $testrun->url = $link;
                $testrun->name = $link;
                $testrun->save();

                $instance = new Testinstance();
                $instance->testrun_id = $testrun->id;
                $instance->save();
                $instance->fetch();
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
