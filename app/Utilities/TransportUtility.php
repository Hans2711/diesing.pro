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
        $this->baseUrl = "https://v5.db.transport.rest";
    }

    public function arrivals($id, $options = [])
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

            $response = $this->client->get(
                "{$this->baseUrl}/stops/$id/arrivals",
                [
                    "query" => $queryParams,
                ]
            );

            $data = json_decode($response->getBody()->getContents(), true);
            return $data;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function departures($id, $options = [])
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

            $response = $this->client->get(
                "{$this->baseUrl}/stops/$id/departures",
                [
                    "query" => $queryParams,
                ]
            );

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
                "{$this->baseUrl}/stations?query=$query&results=8&fuzzy=true",
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

    /**
     * Get stops nearby a given latitude and longitude.
     *
     * @param float $latitude
     * @param float $longitude
     * @param int $results
     * @param int $distance
     * @param bool $stops
     * @param bool $poi
     * @param bool $linesOfStops
     * @param string $language
     * @return array
     */
    public function stopsNearby(
        float $latitude,
        float $longitude,
        int $results = 8,
        int $distance = null,
        bool $stops = true,
        bool $poi = false,
        bool $linesOfStops = false,
        string $language = "de"
    ) {
        $query = [
            "latitude" => $latitude,
            "longitude" => $longitude,
            "results" => $results,
            "distance" => $distance,
            "stops" => $stops ? "true" : "false", // Convert boolean to string
            "poi" => $poi ? "true" : "false", // Convert boolean to string
            "linesOfStops" => $linesOfStops ? "true" : "false", // Convert boolean to string
            "language" => $language,
        ];

        if (
            Cache::has("stopsNearby_" . json_encode($query)) &&
            $this->cacheEnabled
        ) {
            return Cache::get("stopsNearby_" . json_encode($query));
        }

        $query = array_filter(
            $query,
            fn($value) => !is_null($value) && $value !== ""
        );

        try {
            $response = $this->client->get("{$this->baseUrl}/stops/nearby", [
                "query" => $query,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $returnData = [];

            foreach ($data as &$element) {
                if (
                    $element["type"] == "stop" &&
                    array_key_exists("station", $element)
                ) {
                    $tmpStop = $element;
                    unset($tmpStop["station"]);

                    if (
                        array_key_exists($element["station"]["id"], $returnData)
                    ) {
                        $returnData[$element["station"]["id"]]["stops"][
                            $element["id"]
                        ] = $tmpStop; // Corrected the array key
                    } else {
                        $returnData[$element["station"]["id"]] =
                            $element["station"];

                        $returnData[$element["station"]["id"]]["stops"] = [];
                        $returnData[$element["station"]["id"]]["stops"][
                            $element["id"]
                        ] = $tmpStop;
                    }
                } elseif ($element["type"] == "station") {
                    $returnData[$element["id"]] = $element;
                }
            }

            Cache::set("stopsNearby_" . json_encode($query), $returnData);

            return $returnData;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
