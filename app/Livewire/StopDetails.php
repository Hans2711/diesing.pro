<?php

namespace App\Livewire;

use App\Utilities\TransportMapUtility;
use App\Utilities\TransportUtility;
use Livewire\Component;
use Livewire\Attributes\Computed;

class StopDetails extends Component
{
    public $hidden = true;
    public $id = "";

    protected $listeners = [
        'triggerDetails',
    ];

    public function triggerDetails($id) {
        $this->hidden = false;

        if ($id != $this->id) {
            $this->id = $id;
            $this->stream(
                to: 'status',
                content: 'Fetching details',
                replace: true,
            );
        }
    }

    #[Computed]
    public function stop() {
        if ($this->id == "") {
            return null;
        }

        $transportUtility = new TransportUtility();
        $stop = $transportUtility->stops($this->id);
        if (empty($stop)) {
            $stop = $transportUtility->station($this->id);
        }

        $stop = TransportMapUtility::mapStop($stop);

        return $stop;
    }

    public function close() {
        $this->hidden = true;
        $this->id = "";
        $this->stream(
            to: 'status',
            content: 'Closed details',
            replace: true,
        );
    }

    public function render()
    {
        if ($this->stop != null) {
            $this->stream(
                to: 'status',
                content: 'Fetched details successfully',
                replace: true,
            );
        }
        return view('livewire.stop-details');
    }
}
