<?php

namespace App\Livewire;

use App\Utilities\TransportMapUtility;
use App\Utilities\TransportUtility;
use Livewire\Component;
use Livewire\Attributes\Computed;

class StopTrips extends Component
{
    public $hidden = true;
    public $id = "";

    public $date;
    public $hour;
    public $minute;

    public $when;
    public $duration = 10;
    public $options = [];

    public $trips = null;

    protected $listeners = [
        'triggerTrips',
    ];

    public function updateOptions() {
        /* $when =  (new \DateTime($this->when))->format("Y-m-d\TH:i:sP"); */

        /* $this->hour--; */
        $this->when = "{$this->date}T{$this->hour}:{$this->minute}:00";
        /* $this->hour++; */
        $this->options['when'] = $this->when;
        if (!empty($this->duration)) {
            $this->options['duration'] = $this->duration;
        }
    }

    public function updated() {
        $this->updateOptions();
        $transportUtility = new TransportUtility();
        $this->trips = $transportUtility->trips($this->id, 'departures', $this->options);
        $this->trips = TransportMapUtility::mapTrips($this->trips);
    }

    public function triggerTrips($id) {
        $this->hidden = false;

        if ($id != $this->id) {
            $this->id = $id;

            $this->updateOptions();

            $this->stream(
                to: 'status',
                content: 'Fetching trips',
                replace: true,
            );

            $transportUtility = new TransportUtility();
            $this->trips = $transportUtility->trips($this->id, 'departures', $this->options);

            $this->stream(
                to: 'status',
                content: 'Mapping trips',
                replace: true,
            );

            $this->trips = TransportMapUtility::mapTrips($this->trips);

            if (is_array($this->trips) && count($this->trips) > 0) {
                $this->stream(
                    to: 'status',
                    content: 'Fetched trips sucessfully',
                    replace: true,
                );
            } else {
                $this->stream(
                    to: 'status',
                    content: 'Fetched trips empty',
                    replace: true,
                );
            }
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

    public function mount() {
        $now = new \DateTime();
        $this->date = $now->format("Y-m-d");
        $this->hour = $now->format("H");
        $this->minute = $now->format("i");
    }

    public function close() {
        $this->hidden = true;
        $this->id = "";
        $this->stream(
            to: 'status',
            content: 'Closed trips',
            replace: true,
        );
    }

    public function render()
    {
        return view('livewire.stop-trips');
    }
}
