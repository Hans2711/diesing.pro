<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Timetrack as TimetrackModel;
use Carbon\Carbon;

class Timetrack extends Component
{
    public $id;
    public $timetrack;
    public $total = 0;

    public $searchStart;
    public $searchEnd;

    public function mount($id)
    {
        $this->id = $id;
        $this->timetrack = TimetrackModel::find($id);

        if ($this->timetrack) {
            if (is_string($this->timetrack->times)) {
                $this->timetrack->times = json_decode($this->timetrack->times, true) ?: [];
            }
            foreach ($this->timetrack->times as $row) {
                $this->total += $row['duration'];
            }
        }
    }

    public function getFilteredTimesProperty()
    {
        if (!$this->timetrack) {
            return [];
        }

        $times = $this->timetrack->times;

        usort($times, fn ($a, $b) => strtotime($a['time']) <=> strtotime($b['time']));

        $start = $this->searchStart ? strtotime($this->searchStart) : null;
        $end   = $this->searchEnd   ? strtotime($this->searchEnd)   : null;

        usort($times, fn ($a, $b) => strtotime($b['time']) <=> strtotime($a['time']));
        $times = array_filter($times, function ($t) use ($start, $end) {
            $ts = strtotime($t['time']);
            if ($start && $ts < $start) {
                return false;
            }
            if ($end && $ts > $end) {
                return false;
            }
            return true;
        });

        return array_values($times);
    }

    public function getSearchTotalProperty()
    {
        return array_reduce($this->filteredTimes, fn ($c, $t) => $c + $t['duration'], 0);
    }

    private function fmt(int $min): string
    {
        if ($min >= 60) {
            $h = intdiv($min, 60);
            $m = $min % 60;
            return $m ? "{$h}h {$m}m" : "{$h}h";
        }
        return "{$min}m";
    }

    public function render()
    {
        $displayTimes = array_map(function ($row) {
            $row['durationDisplay'] = $this->fmt($row['duration']);
            return $row;
        }, $this->filteredTimes);

        return view('livewire.timetrack', [
            'displayTimes'        => $displayTimes,
            'filteredTimes'      => $this->filteredTimes,
            'totalDisplay'       => $this->fmt($this->total),
            'searchTotalDisplay' => $this->fmt($this->searchTotal),
        ]);
    }
}
