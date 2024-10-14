<?php

namespace App\Utilities;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

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
        // Build the query parameters
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

        // Filter out any null values
        $query = array_filter(
            $query,
            fn($value) => !is_null($value) && $value !== ""
        );

        try {
            // Make the GET request
            $response = $this->client->get("{$this->baseUrl}/stops/nearby", [
                "query" => $query,
            ]);

            // Parse the JSON response
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

            if ($this->cacheEnabled) {
                Cache::set("stopsNearby_" . json_encode($query), $returnData);
            }

            return $returnData;
        } catch (\Exception $e) {
            // Handle exceptions (e.g., network errors, invalid responses)
            return ["error" => $e->getMessage()];
        }
    }
}
