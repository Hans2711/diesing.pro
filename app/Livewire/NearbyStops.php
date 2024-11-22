<?php

namespace App\Livewire;

use App\Http\Controllers\TransportController;
use App\Utilities\TransportMapUtility;
use App\Utilities\TransportUtility;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NearbyStops extends Component
{
    public $latitude;
    public $longitude;
    public $address;

    #[Computed]
    public function stops() {
        if (empty($this->latitude) || empty($this->longitude)) {
            return [];
        }

        $transportUtility = new TransportUtility();

        /* $reachableStops = $transportUtility->getStopsReachableFrom($this->latitude, $this->longitude, $this->address); */
        $reachableStops = $transportUtility->getStopsReachableFrom(51.2165113, 6.7856021, $this->address);
        return TransportMapUtility::mapStops($reachableStops);
    }

    public function mount($latitude, $longitude, $address) {
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function details($id) {
        $this->dispatch('triggerDetails', id: $id);
    }

    public function trips($id) {
        $this->dispatch('triggerTrips', id: $id);
    }

    protected $listeners = [
        'locationUpdated',
        'locationAvailable',
    ];

    public function locationAvailable($latitude, $longitude, $address) {
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function render()
    {
        return view('livewire.nearby-stops');
    }
}
