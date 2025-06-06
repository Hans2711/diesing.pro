<?php

namespace App\Livewire;

use Livewire\Component;

class TestobjectSearch extends Component
{
    public $testobject;

    public $instanceIndex = 0;

    public $instanceCount = 0;

    public $searchTerm = '';

    public $results = [];

    public function mount()
    {
        $this->instanceCount = collect($this->testobject->testruns)
            ->pluck('testinstances')
            ->map->count()
            ->max() ?? 0;
        $this->search();
    }

    public function updated($name)
    {
        if (in_array($name, ['instanceIndex', 'searchTerm'])) {
            $this->search();
        }
    }

    public function search()
    {
        $this->results = [];
        $term = trim($this->searchTerm);
        if ($term === '') {
            return;
        }
        foreach ($this->testobject->testruns as $run) {
            if ($run->testinstances->count() > $this->instanceIndex) {
                $instance = $run->testinstances[$this->instanceIndex];
                $html = $instance->html ?? '';
                $pos = stripos($html, $term);
                if ($pos !== false) {
                    $start = max(0, $pos - 40);
                    $snippet = substr($html, $start, strlen($term) + 80);
                    $snippet = preg_replace('/' . preg_quote($term, '/') . '/i', '<mark>$0</mark>', $snippet);
                    $escaped = htmlspecialchars($snippet, ENT_QUOTES, 'UTF-8');
                    $escaped = str_replace(['&lt;mark&gt;', '&lt;/mark&gt;'], ['<mark>', '</mark>'], $escaped);
                    $this->results[] = [
                        'run' => $run,
                        'snippet' => $escaped,
                    ];
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.testobject-search');
    }
}
