<?php

namespace App\Http\Controllers;

use App\Utilities\TransportUtility;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    protected $transportUtility;

    public function __construct()
    {
        $this->transportUtility = new TransportUtility();
    }

    //
    public function index()
    {
        return view("transport.index");
    }

    public function fetch(Request $request)
    {
        if ($request->get("disableCache")) {
            $this->transportUtility->cacheEnabled = false;
        }

        $lati = $request->get("lati");
        $long = $request->get("long");
        $nearbyStops = $this->transportUtility->stopsNearby($lati, $long);

        $this->transportUtility->cacheEnabled = true;

        return view("transport.fetch", ["stops" => $nearbyStops]);
    }

    public function search(Request $request)
    {
        $query = $request->get("query");
        if ($request->get("disableCache")) {
            $this->transportUtility->cacheEnabled = false;
        }

        $stations = $this->transportUtility->searchStations($query);
        return view("transport.fetch", ["stops" => $stations]);
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

        return view("transport.fetchSingle", [
            "station" => $station,
            "stops" => $stops,
            "transportOptions" => $transportOptions,
        ]);
    }

    public function fetchSingleArrivals($id, Request $request)
    {
        $options = $this->buildOptionsFromRequest($request);
        $arrivals = $this->transportUtility->arrivals($id, $options);

        return view("transport.single.arrivals", ["arrivals" => $arrivals]);
    }

    public function fetchSingleDepartures($id, Request $request)
    {
        $options = $this->buildOptionsFromRequest($request);
        $departures = $this->transportUtility->departures($id, $options);

        return view("transport.single.departures", [
            "departures" => $departures,
        ]);
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
            "nationalExpress" => "bool",
            "national" => "bool",
            "regionalExp" => "bool",
            "regional" => "bool",
            "suburban" => "bool",
            "bus" => "bool",
            "ferry" => "bool",
            "subway" => "bool",
            "tram" => "bool",
            "taxi" => "bool",
            "pretty" => "bool",
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

        return $options;
    }
}
