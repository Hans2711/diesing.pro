<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    //
    public function list()
    {
        $projects= [
            ['title' => 'Project 1'],
            ['title' => 'Project 2'],
            ['title' => 'Project 3'],
            ['title' => 'Project 4'],
            ['title' => 'Project 5'],
        ];

        return view('portfolio.list', [
            'projects' => $projects,
        ]);
    }
}
