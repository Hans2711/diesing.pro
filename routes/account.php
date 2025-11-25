<?php

use App\Http\Controllers\AccountsController;
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

Route::get("/n/{slug}", [
    AccountsController::class,
    "publicNote",
])->name("publicNote");

Route::get("/r/{slug}", [
    AccountsController::class,
    "publicRedirect",
])->name("publicRedirect");

foreach (['de', 'en'] as $locale) {
    Route::prefix($locale)
        ->name($locale . ".")
        ->group(function () use ($locale) {
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
}
