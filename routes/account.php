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

Route::get("/n/{slug}", [AccountsController::class, "publicNote"])->name(
    "publicNote"
);
Route::get("/r/{slug}", [AccountsController::class, "publicRedirect"])->name(
    "publicRedirect"
);


foreach (['de', 'en', 'fr', 'es'] as $locale) {
    Route::prefix($locale)
        ->name($locale . ".")
        ->group(function () use ($locale) {
            Route::get("/" . route_trans("account", $locale), [
                AccountsController::class,
                "index",
            ])->name("account");

            Route::get(
                "/" .
                    route_trans("timetracking", $locale)
                    . "/{id}", [
                        AccountsController::class,
                        "timetrack",
                    ]
            )->name("timetrack");

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

            Route::middleware(["portfolio"])->group(function () use ($locale) {
                Route::get(
                    "/" .
                        route_trans("account", $locale) .
                        "/" .
                        route_trans("portfolio", $locale),
                    function () {
                        return view("accounts.portfolio");
                    }
                )->name("portfolio");
            });
            Route::middleware(["cv"])->group(function () use ($locale) {
                Route::get(
                    "/" .
                        route_trans("account", $locale) .
                        "/" .
                        route_trans("cv", $locale),
                    function () {
                        return view("accounts.cv");
                    }
                )->name("cv");
            });
            Route::middleware(["timetracking"])->group(function () use ($locale) {
                Route::get(
                    "/" .
                        route_trans("account", $locale) .
                        "/" .
                        route_trans("timetracking", $locale),
                    function () {
                        return view("accounts.timetracking");
                    }
                )->name("timetracking");
                Route::get(
                    "/" .
                        route_trans("account", $locale) .
                        "/" .
                        route_trans("timetracking", $locale)
                        . "/{id}",
                    function ($id) {
                        return view("accounts.timetracking-edit", [
                            "id" => $id,
                        ]);
                    }
                )->name("timetracking-edit");
            });
        });
}
