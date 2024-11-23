<?php

namespace App\Utilities;

use App\Models\Geocodestore;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class GeocodeUtility
{
    protected $apiKey = null;
    protected $client;
    protected $baseUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env("MAPS_API_KEY");
        $this->baseUrl = "https://maps.googleapis.com/maps/api/geocode/";
    }

    public function latLngToAddress($lat, $lng)
    {
        $result = Geocodestore::where('key', $lat . $lng)->first();
        if (!empty($result) && !empty($result->content)) {
            return $result->content;
        }

        try {
            $queryParams = [
                "latlng" => $lat . "," . $lng,
                "sensor" => "true",
                "key" => $this->apiKey,
            ];

            $response = $this->client->get("{$this->baseUrl}json", [
                "query" => $queryParams,
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (array_key_exists("error_message", $data)) {
                return ["error" => $data["error_message"]];
            }

            $results = $data["results"];
            $firstResult = $results[0];

            $formattedAddress = $firstResult["formatted_address"];

            $g = new Geocodestore();
            $g->key = $lat . $lng;
            $g->content = $formattedAddress;
            $g->save();

            return $formattedAddress;
        } catch (\Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
