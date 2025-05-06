<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TesterController;
use App\Http\Controllers\ZenquotesController;
use Illuminate\Support\Facades\Route;

if (!function_exists("route_trans")) {
    function route_trans($key, $locale = "en")
    {
        return __("url." . $key, [], $locale);
    }
}

Route::get("/quote/rand", [
    ZenquotesController::class,
    "random",
])->name("grant");

foreach (['de', 'en'] as $locale) {
    Route::prefix($locale)
        ->name($locale . ".")
        ->group(function () use ($locale) {
            Route::get("/", function () {
                return view("home");
            })->name("home");

            Route::get("/" . route_trans("imprint", $locale), function () {
                return view("impressum");
            })->name("imprint");

            Route::get("/" . route_trans("data-protection", $locale), function () {
                return view("datenschutz");
            })->name("dataProtection");

            Route::get("/" . route_trans("portfolio", $locale), [
                PortfolioController::class,
                "list",
            ])->name("portfolio");

            Route::get("/" . route_trans("contact", $locale), [
                ContactController::class,
                "form",
            ])->name("contactForm");

            Route::get("/" . route_trans("contact", $locale) . "/{email}", [
                ContactController::class,
                "form",
            ])->name("contactForm");

            Route::get("/tester/auth", [TesterController::class, "auth"])->name(
                "testerAuth"
            );
            Route::post("/tester/auth", [TesterController::class, "auth"])->name(
                "testerAuthPost"
            );

            Route::get("/tester/diff/{instanceOne}/{instanceTwo}", [
                TesterController::class,
                "diff",
            ])->name("testerDiff");

            Route::middleware(["tester"])->group(function () use ($locale) {
                Route::get("/tester", [TesterController::class, "index"])->name(
                    "testerIndex"
                );
                Route::get("/tester/testobject/{id}", [
                    TesterController::class,
                    "testobject",
                ])->name("testerObject");
                Route::get("/tester/testrun/{id}", [
                    TesterController::class,
                    "testrun",
                ])->name("testerRun");
                Route::get("/tester/testinstance/{id}", [
                    TesterController::class,
                    "instance",
                ])->name("testerInstance");
                Route::get("/tester/testinstance/{id}/fetch", [
                    TesterController::class,
                    "fetchInstance",
                ])->name("testerFetch");
            });

            Route::get("/" . route_trans("teams", $locale), [
                TeamsController::class,
                "index",
            ])->name("teams");

            Route::get("/" . route_trans("rt-share", $locale), function () {
                return view("rt-share.index");
            })->name("rt-share");

            Route::get("/" . route_trans("cv", $locale), [
                CvController::class,
                "index",
            ])->name("cv");

            Route::get("/" . route_trans("cv", $locale) . '/{id}', [
                CvController::class,
                "single",
            ])->name("cv");

            Route::get("/" . route_trans("cv", $locale) . '/{id}/print', [
                CvController::class,
                "print",
            ])->name("cvPrint");
        });
}

Route::get("/", function () {
    return redirect("/de");
});

require base_path("/routes/account.php");
