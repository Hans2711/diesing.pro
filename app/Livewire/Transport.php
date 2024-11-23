<?php

namespace App\Livewire;

use App\Utilities\GeocodeUtility;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Transport extends Component
{
    public $latitude;
    public $longitude;

    public $hideStatus = true;

    protected $listeners = [
        'locationUpdated',
        'locationError',
        'showStatus',
        'hideStatus',
    ];

    public function showStatus() {
        $this->hideStatus = false;
    }

    public function hideStatus() {
        $this->hideStatus = true;
    }

    public function locationUpdated($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        /* $geocodeUtility = new GeocodeUtility(); */
        /* $this->address = $geocodeUtility->latLngToAddress($this->latitude, $this->longitude); */

        /* if (is_array($this->address)) { */
        /*     $this->addError('location', json_encode($this->address)); */
        /*     return; */
        /* } */

        $this->hideStatus = false;
        $this->dispatch('locationAvailable', longitude: $this->longitude, latitude: $this->latitude);
    }

    public function locationError($message)
    {
        $this->addError('location', $message);
    }

    public function render()
    {
        return view('livewire.transport');
    }
}
