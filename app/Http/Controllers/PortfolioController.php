<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
    public function list()
    {
        $projects= [
            [
                'title' => 'Werstener Jonges',
                'description' => 'Der Heimatverein Werstener Jonges ist seit 1953 in Wersten aktiv. Wir pflegen und fördern lokale Traditionen und die Gemeinschaft. Unsere Aktivitäten umfassen Sommerfeste, Bibliotheksprojekte und verschiedene Veranstaltungen.',
                'image' => 'resources/portfolio/werstener-jonges/homepage.png',
                'link' => 'https://werstener-jonges.de/'
            ],
            [
                'title' => 'Hilden Haze',
                'description' => 'Willkommen bei Hilden Haze! Wir sind ein Verein, der im Rahmen der Legalisierung Cannabis gemeinschaftlich anbaut. Unser Ziel ist es, hochwertiges, biologisches Cannabis anzubieten. Wir streben danach, Hilden Haze zu einer sicheren Quelle für legales Cannabis in der Region zu machen',
                'image' => 'resources/portfolio/hilden-haze/homepage.png',
                'link' => 'https://www.hilden-haze.de'
            ],
        ];

        return view('portfolio.list', [
            'projects' => $projects,
        ]);
    }
}
