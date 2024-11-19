<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TesterController;
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

Route::get("/tester", [TesterController::class, "index"]);
Route::get("/tester/testobject/{id}", [TesterController::class, "testobject"]);
Route::get("/tester/testrun/{id}", [TesterController::class, "testrun"]);
Route::get("/tester/testinstance/{id}", [TesterController::class, "instance"]);
Route::get("/tester/testinstance/{id}/fetch", [TesterController::class, "fetchInstance"]);

require base_path("/routes/private.php");
