<?php

namespace App\Utilities;

use App\Models\Stop;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class TransportMapUtility
{

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

        if (isset($data['distance'])) {
            $stop->distance = $data['distance'];
        }

        if (isset($data['entrances'])) {
            $stop->entrances = $data['entrances'];
        }

        return $stop;
    }


    public static function mapStops($apiResponse)
    {
        if (empty($apiResponse) || !array_key_exists('reachable', $apiResponse)) {
            return false;
        }

        $stops = [];

        $reachable = $apiResponse['reachable'];
        foreach ($reachable as $collection) {
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
