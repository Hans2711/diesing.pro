<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivateController;
use Illuminate\Support\Facades\Route;

Route::get("/privater-bereich", [PrivateController::class, "index"]);
Route::post("/privater-bereich", [PrivateController::class, "ReceiveForm"]);

Route::post("/fingerprint", [PrivateController::class, "FingerprintCheck"]);

Route::get("/notiz/{slug}", [PrivateController::class, "PublicNote"]);
Route::post("/notiz/{slug}", [PrivateController::class, "PublicNote"]);

Route::get("/r/{slug}", [PrivateController::class, "Redirect"]);

Route::middleware(["private"])->group(function () {
    Route::get("/privater-bereich/notizen", [
        PrivateController::class,
        "notes",
    ]);
    Route::get("/privater-bereich/notizen/get/{id}", [
        PrivateController::class,
        "getNote",
    ]);
    Route::post("/privater-bereich/notizen/update/{id}", [
        PrivateController::class,
        "updateNote",
    ]);
    Route::post("/privater-bereich/notizen/delete/{id}", [
        PrivateController::class,
        "deleteNote",
    ]);

    Route::get("/privater-bereich/weiterleitungen", [
        PrivateController::class,
        "redirector",
    ]);
    Route::post("/privater-bereich/weiterleitungen/push", [
        PrivateController::class,
        "pushRedirect",
    ]);
    Route::post("/privater-bereich/weiterleitungen/delete", [
        PrivateController::class,
        "deleteRedirect",
    ]);
    Route::get("/privater-bereich/weiterleitungen/get-list", [
        PrivateController::class,
        "getRedirectsList",
    ]);

    Route::get("/privater-bereich/dateien", [
        PrivateController::class,
        "files",
    ]);
});
