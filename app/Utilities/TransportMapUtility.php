<?php

namespace App\Utilities;

use App\Models\Stop;
use App\Models\Trip;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class TransportMapUtility
{

    public static function mapTrips($apiResponse) {
        if (!array_key_exists('departures', $apiResponse)) {
            return false;
        }

        $departures = $apiResponse['departures'];

        $trips = [];
        foreach ($departures as $dep) {
            $trips[] = self::mapTrip($dep);
        }

        return $trips;
    }

    public static function mapTrip($data) {
        $trip = new Trip();

        if (isset($data['tripId'])) {
            $trip->id = $data['tripId'];
        }

        if (isset($data['stop'])) {
            try {$data['lines'] = $data['stop']['station']['lines'];} catch (\Exception $e) {}
            $trip->stop = self::mapStop($data['stop']);
        }

        if (isset($data['when'])) {
            $trip->when = $data['when'];
        }

        if (isset($data['plannedWhen'])) {
            $trip->plannedWhen = $data['plannedWhen'];
        }

        if (isset($data['delay'])) {
            $trip->delay = $data['delay'];
        }

        if (isset($data['platform'])) {
            $trip->platform = $data['platform'];
        }

        if (isset($data['plannedPlatform'])) {
            $trip->plannedPlatform = $data['plannedPlatform'];
        }

        if (isset($data['prognosedPlatform'])) {
            $trip->prognosedPlatform = $data['prognosedPlatform'];
        }

        if (isset($data['prognosisType'])) {
            $trip->prognosisType = $data['prognosisType'];
        }

        if (isset($data['direction'])) {
            $trip->direction = $data['direction'];
        }

        if (isset($data['provenance'])) {
            $trip->provenance = $data['provenance'];
        }

        if (isset($data['line'])) {
            $trip->line = json_encode($data['line']);
        }

        if (isset($data['remarks'])) {
            $trip->remarks = json_encode($data['remarks']);
        }

        if (isset($data['origin'])) {
            $trip->origin = self::mapStop($data['origin']);
        }

        if (isset($data['destination'])) {
            $trip->destination = self::mapStop($data['destination']);
        }

        if (isset($data['cancelled'])) {
            $trip->cancelled = $data['cancelled'];
        }

        return $trip;
    }

    public static function mapStop($data) {
        $stop = new Stop();

        if (isset($data['type'])) {
            $stop->type = $data['type'];
        }

        if (isset($data['id'])) {
            $stop->id = $data['id'];
        }

        if (isset($data['name'])) {
            $stop->name = $data['name'];
        }

        if (isset($data['location'])) {
            $stop->location = json_encode($data['location']);
        }

        if (isset($data['products'])) {
            $stop->products = json_encode($data['products']);
        }

        if (isset($data['lines'])) {
            $stop->products = json_encode($data['lines']);
        }

        if (isset($data['distance'])) {
            $stop->distance = $data['distance'];
        }

        if (isset($data['entrances'])) {
            $stop->entrances = $data['entrances'];
        }

        return $stop;
    }

    public static function mapStops($apiResponse) {
        if (empty($apiResponse) || count($apiResponse) == 0) {
            return [];
        }

        $stops = [];
        foreach ($apiResponse as $single) {
            $stop = self::mapStop($single);

            $stops[]  = $stop;
        }

        return $stops;
    }


    public static function mapStopsReachable($apiResponse)
    {
        if (empty($apiResponse) || count($apiResponse) == 0) {
            return [];
        }

        $stops = [];

        foreach ($apiResponse as $collection) {
            $distance = $collection['duration'];

            foreach ($collection['stations'] as $station) {
                $deepestStation = self::findDeepestStation($station);

                if (array_key_exists($deepestStation['id'], $stops))
                continue;

                $deepestStation['distance'] = $distance;

                $stop = self::mapStop($deepestStation);

                $stops[$stop->id] = $stop;
            }
        }

        return $stops;
    }

    private static function findDeepestStation($array) {
        if (!array_key_exists('station', $array)) {
            return $array;
        } else {
            if (array_key_exists('station', $array)) {
                return self::findDeepestStation($array['station']);
            } else {
                return false;
            }
        }
    }
}
