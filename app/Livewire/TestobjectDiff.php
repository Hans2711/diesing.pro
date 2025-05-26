<?php

namespace App\Livewire;

use Livewire\Component;

class TestobjectDiff extends Component
{
    public $testobject;

    public $diffs = [];

    public $hideDiff = [];

    public $instanceCount = 0;

    public $instanceOne = 1;

    public $instanceTwo = 0;

    public $renderName = 'Inline';

    public $detailLevel = 'line';

    public function mount()
    {
        $this->instanceCount = collect($this->testobject->testruns)
            ->pluck('testinstances')
            ->map->count()
            ->max() ?? 0;

        foreach ($this->testobject->testruns as $run) {
            $this->hideDiff[$run->id] = false;
        }

        $this->generateDiff();
    }

    public function updated($name)
    {
        if (in_array($name, ['instanceOne', 'instanceTwo', 'renderName', 'detailLevel'])) {
            $this->generateDiff();
        }
    }

    public function updateDiff()
    {
        $this->generateDiff();
    }

    public function toggleRun($runId)
    {
        if (isset($this->hideDiff[$runId])) {
            $this->hideDiff[$runId] = ! $this->hideDiff[$runId];
        }
    }

    protected function generateDiff()
    {
        if ($this->instanceOne >= $this->instanceCount || $this->instanceTwo >= $this->instanceCount) {
            $this->diff = '<p>Invalid instance selection.</p>';

            return;
        }
        $this->instanceCount = 0;
        $this->diffs = [];
        foreach ($this->testobject->testruns as $run) {
            if ($run->testinstances->count() > $this->instanceCount) {
                $this->instanceCount = $run->testinstances->count();
            }

            $diffHtml = '';
            if (
                $run->testinstances->count() > max($this->instanceOne, $this->instanceTwo) &&
                    isset($run->testinstances[$this->instanceOne]) &&
                    isset($run->testinstances[$this->instanceTwo]) &&
                    ! empty($run->testinstances[$this->instanceOne]->html) &&
                    ! empty($run->testinstances[$this->instanceTwo]->html)
            ) {
                $a = $run->testinstances[$this->instanceOne];
                $b = $run->testinstances[$this->instanceTwo];
                $diffHtml = $a->diff($b, $this->renderName, [], ['detailLevel' => $this->detailLevel]);
            }

            $this->diffs[$run->id] = [
                'run' => $run,
                'diff' => $diffHtml,
            ];
        }
    }

    public function render()
    {
        return view('livewire.testobject-diff');
    }
}
