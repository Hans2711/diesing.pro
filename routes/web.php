<?php

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

///////////////////////////
// GROUP: DE Routes
///////////////////////////
Route::prefix("de")
    ->name("de.")
    ->group(function () {
        $locale = "de"; // Define the locale for this group

        // Home: /de
        Route::get("/", function () {
            return view("home");
        })->name("home");

        // Impressum: /de/impressum
        Route::get("/" . route_trans("imprint", $locale), function () {
            return view("impressum");
        })->name("imprint");

        // Datenschutz: /de/datenschutz
        Route::get("/" . route_trans("data-protection", $locale), function () {
            return view("datenschutz");
        })->name("dataProtection");

        // Portfolio: /de/portfolio
        Route::get("/" . route_trans("portfolio", $locale), [
            PortfolioController::class,
            "list",
        ])->name("portfolio");

        // Kontakt (Form): /de/kontakt
        Route::get("/" . route_trans("contact", $locale), [
            ContactController::class,
            "form",
        ])->name("contactForm");

        Route::get("/" . route_trans("contact", $locale) . "/{email}", [
            ContactController::class,
            "form",
        ])->name("contactForm");

        // Tester stuff, etc.
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

        // Teams: /de/teams
        Route::get("/" . route_trans("teams", $locale), [
            TeamsController::class,
            "index",
        ])->name("teams");
    });

///////////////////////////
// GROUP: EN Routes
///////////////////////////
Route::prefix("en")
    ->name("en.")
    ->group(function () {
        $locale = "en"; // Define the locale for this group

        // Home: /en
        Route::get("/", function () {
            return view("home");
        })->name("home");

        // Imprint: /en/imprint
        Route::get("/" . route_trans("imprint", $locale), function () {
            return view("impressum");
        })->name("imprint");

        // Data Protection: /en/data-protection
        Route::get("/" . route_trans("data-protection", $locale), function () {
            return view("datenschutz");
        })->name("dataProtection");

        // Portfolio: /en/portfolio
        Route::get("/" . route_trans("portfolio", $locale), [
            PortfolioController::class,
            "list",
        ])->name("portfolio");

        // Contact (Form): /en/contact
        Route::get("/" . route_trans("contact", $locale), [
            ContactController::class,
            "form",
        ])->name("contactForm");

        Route::get("/" . route_trans("contact", $locale) . "/{email}", [
            ContactController::class,
            "form",
        ])->name("contactForm");

        // Tester stuff
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

        // Teams: /en/teams
        Route::get("/" . route_trans("teams", $locale), [
            TeamsController::class,
            "index",
        ])->name("teams");
    });

///////////////////////////
// OPTIONAL: Default Redirect
///////////////////////////
// Redirect root URL to default language, e.g., /de
Route::get("/", function () {
    return redirect("/de");
});

require base_path("/routes/account.php");
