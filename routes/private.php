<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivateController;
use Illuminate\Support\Facades\Route;

// Define a helper to fetch route segments based on language
if (!function_exists("route_trans")) {
    function route_trans($key, $locale = "en")
    {
        return __("url." . $key, [], $locale);
    }
}

Route::post("/fingerprint", [
    PrivateController::class,
    "FingerprintCheck",
])->name("fingerprint.check");

Route::get("/n/{slug}", [PrivateController::class, "PublicNote"])->name(
    "publicNote.get"
);
Route::post("/n/{slug}", [PrivateController::class, "PublicNote"])->name(
    "publicNote.post"
);

///////////////////////////
// GROUP: DE Routes
///////////////////////////
Route::prefix("de")
    ->name("de.")
    ->group(function () {
        $locale = "de";
        // Private Area: /de/privater-bereich
        Route::get("/" . route_trans("private-area", $locale), [
            PrivateController::class,
            "index",
        ])->name("private.index");
        Route::post("/" . route_trans("private-area", $locale), [
            PrivateController::class,
            "auth",
        ])->name("private.auth");

        // Redirect: /de/weiterleitung/{slug}
        Route::get("/" . route_trans("redirect", $locale) . "/{slug}", [
            PrivateController::class,
            "Redirect",
        ])->name("redirect");

        // Protected Routes with Middleware "private": /de/privater-bereich/*
        Route::middleware(["private"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("notes", $locale),
                [PrivateController::class, "notes"]
            )->name("private.notes");
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("redirects", $locale),
                [PrivateController::class, "redirector"]
            )->name("private.redirector");
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("files", $locale),
                [PrivateController::class, "files"]
            )->name("private.files");
        });
    });

///////////////////////////
// GROUP: EN Routes
///////////////////////////
Route::prefix("en")
    ->name("en.")
    ->group(function () {
        $locale = "en";
        // Private Area: /en/private-area
        Route::get("/" . route_trans("private-area", $locale), [
            PrivateController::class,
            "index",
        ])->name("private.index");
        Route::post("/" . route_trans("private-area", $locale), [
            PrivateController::class,
            "auth",
        ])->name("private.auth");

        // Redirect: /en/redirect/{slug}
        Route::get("/" . route_trans("redirect", $locale) . "/{slug}", [
            PrivateController::class,
            "Redirect",
        ])->name("redirect");

        // Protected Routes with Middleware "private": /en/private-area/*
        Route::middleware(["private"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("notes", $locale),
                [PrivateController::class, "notes"]
            )->name("private.notes");
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("redirects", $locale),
                [PrivateController::class, "redirector"]
            )->name("private.redirector");
            Route::get(
                "/" .
                    route_trans("private-area", $locale) .
                    "/" .
                    route_trans("files", $locale),
                [PrivateController::class, "files"]
            )->name("private.files");
        });
    });

///////////////////////////
// OPTIONAL: Default Redirect
///////////////////////////
// Redirect root URL to default language, e.g., /en
Route::get("/", function () {
    return redirect("/en");
});
