<?php

namespace App\Livewire;

use App\Utilities\GeocodeUtility;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Transport extends Component
{
    public $latitude;

    public $longitude;

    public $address;

    protected $listeners = [
        'locationUpdated',
        'locationError',
    ];

    public function locationUpdated($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $geocodeUtility = new GeocodeUtility();
        $this->address = $geocodeUtility->latLngToAddress($this->latitude, $this->longitude);

        if (is_array($this->address)) {
            $this->addError('location', json_encode($this->address));
        }

        $this->dispatch('locationAvailable', longitude: $this->longitude, latitude: $this->latitude, address: $this->address);
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
