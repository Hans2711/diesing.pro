<?php

use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

Route::get("/tester/auth", [TesterController::class, "auth"]);
Route::post("/tester/auth", [TesterController::class, "auth"]);

Route::get("/tester/diff/{instanceOne}/{instanceTwo}", [TesterController::class, "diff"]);

Route::middleware(["tester"])->group(function () {
    Route::get("/tester", [TesterController::class, "index"]);
    Route::get("/tester/testobject/{id}", [TesterController::class, "testobject"]);
    Route::get("/tester/testrun/{id}", [TesterController::class, "testrun"]);
    Route::get("/tester/testinstance/{id}", [TesterController::class, "instance"]);
    Route::get("/tester/testinstance/{id}/fetch", [TesterController::class, "fetchInstance"]);
});
