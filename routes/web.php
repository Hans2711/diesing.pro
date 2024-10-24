<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TransportController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("home");
});
Route::get("/impressum", function () {
    return view("impressum");
});
Route::get("/datenschutz", function () {
    return view("datenschutz");
});

Route::get("/portfolio", [PortfolioController::class, "list"]);

Route::get("/kontakt", [ContactController::class, "form"]);
Route::post("/kontakt/abschicken", [ContactController::class, "submit"]);

Route::get("/transport", [TransportController::class, "index"]);
Route::get("/transport/fetch", [TransportController::class, "fetch"]);
Route::get("/transport/fetch/{id}", [
    TransportController::class,
    "fetchSingle",
]);

Route::get("/transport/fetch/trips/{id}/{type}", [
    TransportController::class,
    "fetchTrips",
]);

Route::get("/transport/fetch/trip/details", [
    TransportController::class,
    "fetchTrip",
]);

Route::get("/transport/search/", [TransportController::class, "search"]);

require base_path("/routes/private.php");
