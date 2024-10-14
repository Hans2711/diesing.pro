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
        $lati = $request->get("lati");
        $long = $request->get("long");
        $nearbyStops = $this->transportUtility->stopsNearby($lati, $long);

        return view("transport.fetch", ["stops" => $nearbyStops]);
    }
}
