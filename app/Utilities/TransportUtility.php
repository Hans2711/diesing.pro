<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use VARIANT;

class TransportUtility
{
    protected $client;
    protected $baseUrl;

    public $cacheEnabled = true;

    public function __construct()
    {
        // Initialize the Guzzle client
        $this->client = new Client();
        $this->baseUrl = "https://v6.db.transport.rest";
    }

    public function getAllStations()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/stations", []);
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function trip($id)
    {
        try {
            $encodedId = urlencode($id);
            $response = $this->client->get(
                "{$this->baseUrl}/trips/{$encodedId}?language=de",
                []
            );
            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function trips($id, $type, $options = [])
    {
        try {
            $defaults = [
                "when" => null,
                "direction" => null,
                "duration" => 10,
                "results" => null,
                "linesOfStops" => false,
                "remarks" => true,
                "language" => "de",
                "nationalExpress" => true,
                "national" => true,
                "regionalExp" => true,
                "regional" => true,
                "suburban" => true,
                "bus" => true,
                "ferry" => true,
                "subway" => true,
                "tram" => true,
                "taxi" => true,
                "pretty" => true,
            ];

            $queryParams = array_merge($defaults, $options);

            foreach ($queryParams as $key => $value) {
                if (is_bool($value)) {
                    $queryParams[$key] = $value ? "true" : "false";
                }
            }

            $queryParams = array_filter($queryParams, function ($value) {
                return $value !== null;
            });

            $response = $this->client->get("{$this->baseUrl}/stops/$id/$type", [
                "query" => $queryParams,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function stops($id)
    {
        if (Cache::has("stops_" . json_encode($id)) && $this->cacheEnabled) {
            return Cache::get("stops_" . json_encode($id));
        }

        try {
            $response = $this->client->get("{$this->baseUrl}/stops/$id", []);
            $data = json_decode($response->getBody()->getContents(), true);

            Cache::set("stop_" . json_encode($id), $data);

            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function searchStations($query)
    {
        if (
            Cache::has("searchStations_" . json_encode($query)) &&
            $this->cacheEnabled
        ) {
            return Cache::get("searchStations_" . json_encode($query));
        }

        try {
            $response = $this->client->get(
                "{$this->baseUrl}/stations?query=$query&results=4&fuzzy=true",
                []
            );
            $data = json_decode($response->getBody()->getContents(), true);

            Cache::set("searchStations_" . json_encode($query), $data);

            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function station($id)
    {
        if (Cache::has("station_" . json_encode($id)) && $this->cacheEnabled) {
            return Cache::get("station_" . json_encode($id));
        }

        try {
            $response = $this->client->get("{$this->baseUrl}/stations/$id", []);
            $data = json_decode($response->getBody()->getContents(), true);

            Cache::set("station_" . json_encode($id), $data);

            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function getStopsReachableFrom(
        $latitude,
        $longitude,
        $address,
        $options = []
    ) {
        if (
            Cache::has(
                "getStopsReachableFrom_" . $latitude . $longitude . $address
            ) &&
            $this->cacheEnabled
        ) {
            return Cache::get(
                "getStopsReachableFrom_" . $latitude . $longitude . $address
            );
        }
        try {
            $defaults = [
                "latitude" => $latitude,
                "longitude" => $longitude,
                "address" => $address,
                "when" => null,
                "maxTransfers" => 5,
                "maxDuration" => null,
                "language" => "en",
                "nationalExpress" => true,
                "national" => true,
                "regionalExpress" => true,
                "regional" => true,
                "suburban" => true,
                "bus" => true,
                "ferry" => true,
                "subway" => true,
                "tram" => true,
                "taxi" => true,
                "pretty" => true,
            ];

            $queryParams = array_merge($defaults, $options);

            // Convert boolean values to string representation
            foreach ($queryParams as $key => $value) {
                if (is_bool($value)) {
                    $queryParams[$key] = $value ? "true" : "false";
                }
            }

            // Remove null values from query parameters
            $queryParams = array_filter($queryParams, function ($value) {
                return $value !== null;
            });

            $response = $this->client->get(
                "{$this->baseUrl}/stops/reachable-from",
                [
                    "query" => $queryParams,
                ]
            );

            $data = json_decode($response->getBody()->getContents(), true);
            if (!array_key_exists("error", $data)) {
                Cache::set(
                    "getStopsReachableFrom_" .
                        $latitude .
                        $longitude .
                        $address,
                    $data
                );
            }

            $stops = [];
            $reachableStops = $data["reachable"];

            // foreach ($reachableStops as &$stop) {
            //     $stop["station"] = array_values($stop["stations"])[0][
            //         "station"
            //     ];
            // }

            return $reachableStops;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
