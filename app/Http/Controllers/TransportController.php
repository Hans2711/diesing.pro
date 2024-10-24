<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Utilities\GeocodeUtility;
use App\Utilities\TransportUtility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use League\CommonMark\Environment\Environment;
use Psy\Util\Json;

class TransportController extends Controller
{
    protected $transportUtility;
    protected $geocodeUtility;

    public function __construct()
    {
        $this->transportUtility = new TransportUtility();
        $this->geocodeUtility = new GeocodeUtility();
    }

    protected function returnJson($data)
    {
        if (array_key_exists("error", $data)) {
            return new JsonResponse($data, 400);
        }
        return new JsonResponse($data, 200);
    }

    //
    public function index()
    {
        /* $stations = $this->transportUtility->getAllStations(); */
        /* $stations = Station::all(); */
        /* dd($stations); */

        return view("transport.index");
    }

    public function fetch(Request $request)
    {
        $path = app_path("example-jsons/stops.json");
        $path = str_replace("/app", "", $path);
        return new JsonResponse(json_decode(file_get_contents($path), true));

        if ($request->get("disableCache")) {
            $this->transportUtility->cacheEnabled = false;
        }

        $lati = $request->get("lati");
        $long = $request->get("long");

        $address = $this->geocodeUtility->latLngToAddress($lati, $long);

        $nearbyStops = $this->transportUtility->getStopsReachableFrom(
            $lati,
            $long,
            $address
        );

        // dd($nearbyStops);

        return $this->returnJson($nearbyStops);
    }

    public function search(Request $request)
    {
        $query = $request->get("query");

        $stations = Station::search($query)->get();

        $results = [];

        foreach ($stations as $station) {
            $results[] = json_decode($station->data, true);
        }

        $dbSearch = $this->transportUtility->searchStations($query);
        $results = array_merge($dbSearch, $results);

        return view("transport.fetch", ["stops" => $results]);
    }

    public function fetchSingle($id, Request $request)
    {
        $station = $this->transportUtility->station($id);
        $stops = $this->transportUtility->stops($id);

        $transportOptions = [];

        if (array_key_exists("products", $stops)) {
            $transportOptions = $stops["products"];
            $transportOptions = array_filter($transportOptions);
            $transportOptions = array_keys($transportOptions);
        }

        if (array_key_exists("products", $station)) {
            $transportOptions = $station["products"];
            $transportOptions = array_filter($transportOptions);
            $transportOptions = array_keys($transportOptions);
        }

        return $this->returnJson([
            "station" => $station,
            "stops" => $stops,
            "transportOptions" => $transportOptions,
            "csrfToken" => csrf_token(),
        ]);
    }

    public function fetchTrip(Request $request)
    {
        $id = $request->get("id");

        $trip = $this->transportUtility->trip($id);
        return $this->returnJson($trip);
    }

    public function fetchTrips($id, $type, Request $request)
    {
        // $path = app_path("example-jsons/trips.json");
        // $path = str_replace("/app", "", $path);
        // return new JsonResponse(json_decode(file_get_contents($path), true));

        $options = $this->buildOptionsFromRequest($request);
        $trips = $this->transportUtility->trips($id, $type, $options);

        return $this->returnJson($trips);
    }

    private function buildOptionsFromRequest(Request $request)
    {
        $expectedOptions = [
            "when" => "string",
            "direction" => "string",
            "duration" => "int",
            "results" => "int",
            "linesOfStops" => "bool",
            "remarks" => "bool",
            "language" => "string",
            "pretty" => "bool",
        ];

        $transportationOptions = [
            "nationalExpress",
            "national",
            "regionalExp",
            "regional",
            "suburban",
            "bus",
            "ferry",
            "subway",
            "tram",
            "taxi",
        ];

        $options = [];

        foreach ($expectedOptions as $key => $type) {
            if ($request->has($key)) {
                $value = $request->input($key);

                switch ($type) {
                    case "int":
                        $options[$key] = intval($value);
                        break;
                    case "bool":
                        $options[$key] = filter_var(
                            $value,
                            FILTER_VALIDATE_BOOLEAN
                        );
                        break;
                    case "string":
                    default:
                        $options[$key] = $value;
                        break;
                }
            }
        }

        $transportationOptionEnabled = false;
        foreach ($transportationOptions as $option) {
            if (
                $request->has($option) &&
                filter_var($request->input($option), FILTER_VALIDATE_BOOLEAN)
            ) {
                $options[$option] = true;
            } else {
                $options[$option] = false;
            }
        }

        return $options;
    }
}
