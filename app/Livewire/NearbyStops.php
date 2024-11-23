<?php

namespace App\Livewire;

use App\Utilities\TransportMapUtility;
use App\Utilities\TransportUtility;
use Livewire\Attributes\Computed;
use Livewire\Component;

class NearbyStops extends Component
{
    public $latitude;
    public $longitude;
    public $locationInitialized = false;

    public $stopsOrigin = 'none';
    public $stopsInitialized = false;
    public $stopsEmpty = true;
    public $stopsError = '';

    public $search;

    #[Computed]
    public function stops()
    {
        $transportUtility = new TransportUtility();

        $this->stopsOrigin = 'none';
        if (empty($this->search)) {
            if (empty($this->latitude) || empty($this->longitude)) {
                $this->locationInitialized = false;
                $this->stopsInitialized = false;
                $this->stopsEmpty = true;
                return null;
            } else {
                $reachableStops = $transportUtility->nearbyLocations(
                    $this->latitude,
                    $this->longitude,
                );
                $this->stopsOrigin = 'location';

                if (array_key_exists('error', $reachableStops)) {
                    $this->locationInitialized = true;
                    $this->stopsInitialized = true;
                    $this->stopsEmpty = true;
                    $this->stopsError = $reachableStops['error'];
                    return null;
                }

                $this->locationInitialized = true;
                $this->stopsInitialized = true;

                if (count($reachableStops) > 0)
                    $this->stopsEmpty = false;
                else
                    $this->stopsEmpty = true;

                return TransportMapUtility::mapStops($reachableStops);
            }
        } else {
            $result = $transportUtility->searchLocations($this->search);
            $this->stopsOrigin = 'search';

            if (array_key_exists('error', $result)) {
                $this->locationInitialized = true;
                $this->stopsInitialized = true;
                $this->stopsEmpty = true;
                $this->stopsError = $result['error'];
                return null;
            }

            $this->locationInitialized = true;
            $this->stopsInitialized = true;

            if (count($result) > 0)
                $this->stopsEmpty = false;
            else
                $this->stopsEmpty = true;

            return TransportMapUtility::mapStops($result);
        }
    }

    public function mount($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        if (!empty($this->latitude) && !empty($this->longitude)) {
            $this->locationInitialized = true;
        }
    }

    public function details($id)
    {
        $this->dispatch('triggerDetails', id: $id);
    }

    public function trips($id)
    {
        $this->dispatch('triggerTrips', id: $id);
    }

    protected $listeners = [
        'locationAvailable',
    ];

    public function locationAvailable($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        if (!empty($this->latitude) && !empty($this->longitude)) {
            $this->locationInitialized = true;
        }

        $this->stops;

        $this->stream(
            to: 'status',
            content: 'Fetching stops',
            replace: true,
        );
    }

    public function render()
    {
        if ($this->stopsInitialized) {
            if ($this->stopsEmpty) {
                $this->stream(
                    to: 'status',
                    content: 'Fetched stops are empty',
                    replace: true,
                );
            } else {
                $this->stream(
                    to: 'status',
                    content: 'Fetched stops successfully',
                    replace: true,
                );
            }
        }
        return view('livewire.nearby-stops');
    }
}
