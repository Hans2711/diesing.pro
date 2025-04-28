<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Timetrack;
use Illuminate\Support\Facades\Validator;

class TimetrackEditSingle extends Component
{
    public $id;
    public $timetrack = [
        'title' => '',
        'times' => [],
    ];

    public function mount($id)
    {
        $this->id  = $id;
        $model     = Timetrack::find($id);

        $this->timetrack = [
            'title' => $model ? $model->title ?? '' : '',
            'times' => $model ? $model->times ?? [] : [],
        ];
    }

    public function addTimeTrack()
    {
        $this->timetrack['times'][] = [
            'title'    => '',
            'time'     => now()->format('Y-m-d\TH:i'),
            'duration' => '',
        ];
    }

    public function removeTimeTrack($index)
    {
        unset($this->timetrack['times'][$index]);
        $this->timetrack['times'] = array_values($this->timetrack['times']);
    }

    public function updateTimetrack()
    {
        foreach ($this->timetrack['times'] as &$row) {
            $row['duration'] = $this->toMinutes($row['duration']);
        }

        if ($tt = Timetrack::find($this->id)) {
            $tt->title = $this->timetrack['title'];
            $tt->times = json_encode($this->timetrack['times']);
            $tt->save();
            session()->flash('message', 'Successfully updated the timetrack.');
        }
    }

    private function toMinutes(string $input): int
    {
        if (is_numeric(trim($input))) {
            return (int) trim($input);
        }

        preg_match('/(?:(\d+)\s*h)?\s*(?:(\d+)\s*m)?/i', $input, $m);
        $h = isset($m[1]) && $m[1] !== '' ? (int)$m[1] : 0;
        $m = isset($m[2]) && $m[2] !== '' ? (int)$m[2] : 0;

        return $h * 60 + $m;
    }

    public function render()
    {
        return view('livewire.timetrack-edit-single');
    }
}
