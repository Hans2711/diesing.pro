<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home'); });
Route::get('/impressum', function () { return view('impressum'); });
Route::get('/datenschutz', function () { return view('datenschutz'); });

Route::get('/portfolio', [PortfolioController::class, 'list']);

Route::get('/kontakt', [ContactController::class, 'form']);
