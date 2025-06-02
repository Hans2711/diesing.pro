<?php

namespace App\Livewire;

use App\Models\Timetrack;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TimetrackEdit extends Component
{
    public $timetracks;

    public function mount()
    {
        $this->timetracks = Timetrack::where('user', Auth::id())->get();
    }

    public function createTimetrack()
    {
        $this->timetracks->push(Timetrack::makeInstance('New Timetrack', '[]'));
        $this->timetracks->last()->user = Auth::id();
        $this->timetracks->last()->save();
    }

    public function deleteTimetrack($id) {
        $timetrack = Timetrack::find($id);
        if ($timetrack) {
            $timetrack->delete();
            $this->timetracks = $this->timetracks->filter(function ($item) use ($id) {
                return $item->id != $id;
            });
        }
    }

    public function render()
    {
        return view('livewire.timetrack-edit');
    }
}
