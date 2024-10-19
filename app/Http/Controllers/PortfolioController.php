<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
    public function list()
    {
        $projects = [
            [
                "title" => "Werstener Jonges",
                "description" =>
                    "Der Heimatverein Werstener Jonges ist seit 1953 in Wersten aktiv. Wir pflegen und fördern lokale Traditionen und die Gemeinschaft. Unsere Aktivitäten umfassen Sommerfeste, Bibliotheksprojekte und verschiedene Veranstaltungen.",
                "image" => "resources/portfolio/werstener-jonges/homepage.png",
                "link" => "https://werstener-jonges.de/",
            ],
        ];

        return view("portfolio.list", [
            "projects" => $projects,
        ]);
    }
}
