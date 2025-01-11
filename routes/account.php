<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

if (!function_exists("route_trans")) {
    function route_trans($key, $locale = "en")
    {
        return __("url." . $key, [], $locale);
    }
}

Route::get("/grant/{username}/{permission}/{permission_token}", [
    AccountsController::class,
    "grant",
])->name("grant");

Route::get("/ungrant/{username}/{permission}/{permission_token}", [
    AccountsController::class,
    "ungrant",
])->name("ungrant");

///////////////////////////
// GROUP: DE Routes
///////////////////////////
Route::prefix("de")
    ->name("de.")
    ->group(function () {
        $locale = "de";

        Route::get("/" . route_trans("account", $locale), [
            AccountsController::class,
            "index",
        ])->name("account");

        Route::middleware(["notes"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("account", $locale) .
                    "/" .
                    route_trans("notes", $locale),
                function () {
                    return view("accounts.notes");
                }
            )->name("notes");
        });

        Route::middleware(["redirects"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("account", $locale) .
                    "/" .
                    route_trans("redirects", $locale),
                function () {
                    return view("accounts.redirects");
                }
            )->name("redirects");
        });
    });

///////////////////////////
// GROUP: EN Routes
///////////////////////////
Route::prefix("en")
    ->name("en.")
    ->group(function () {
        $locale = "en";

        Route::get("/" . route_trans("account", $locale), [
            AccountsController::class,
            "index",
        ])->name("account");

        Route::middleware(["notes"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("account", $locale) .
                    "/" .
                    route_trans("notes", $locale),
                function () {
                    return view("accounts.notes");
                }
            )->name("notes");
        });

        Route::middleware(["redirects"])->group(function () use ($locale) {
            Route::get(
                "/" .
                    route_trans("account", $locale) .
                    "/" .
                    route_trans("redirects", $locale),
                function () {
                    return view("accounts.redirects");
                }
            )->name("redirects");
        });
    });
