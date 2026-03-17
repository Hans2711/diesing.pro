<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TeamsController;
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
])->name("quoteRand");

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

            Route::get("/" . route_trans("contact", $locale), [
                ContactController::class,
                "form",
            ])->name("contactForm");

            // Redirect old contact form with email parameter to new simplified form
            Route::get("/" . route_trans("contact", $locale) . "/{email}", function () use ($locale) {
                return redirect()->route("contactForm", ["locale" => $locale]);
            });

            Route::get("/" . route_trans("teams", $locale), [
                TeamsController::class,
                "index",
            ])->name("teams");

            Route::get("/" . route_trans("rt-share", $locale), function () {
                return view("rt-share.index");
            })->name("rt-share");

            Route::view("/" . route_trans("cv", $locale), "cv.index")->name("cv");

            Route::get("/" . route_trans("search", $locale), [
                SearchController::class,
                "search",
            ])->name("search");
        });
}

Route::get("/", function () {
    return redirect("/de");
});
