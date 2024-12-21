<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ShareController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

///////////////////////////
// GROUP: DE Routes
///////////////////////////
Route::prefix("de")
    ->name("de.")
    ->group(function () {
        // Home: /de
        Route::get("/", function () {
            return view("home");
        })->name("home");

        // Impressum: /de/impressum
        Route::get("/impressum", function () {
            return view("impressum");
        })->name("impressum");

        // Datenschutz: /de/datenschutz
        Route::get("/datenschutz", function () {
            return view("datenschutz");
        })->name("datenschutz");

        // Portfolio: /de/portfolio
        Route::get("/portfolio", [PortfolioController::class, "list"])->name(
            "portfolio"
        );

        // Kontakt (Form): /de/kontakt
        Route::get("/kontakt", [ContactController::class, "form"])->name(
            "contactForm"
        );

        // Kontakt (Submit): /de/kontakt/abschicken
        Route::post("/kontakt/abschicken", [
            ContactController::class,
            "submit",
        ])->name("contactSubmit");

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

        Route::middleware(["tester"])->group(function () {
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
        Route::get("/teams", [TeamsController::class, "index"])->name("teams");
    });

///////////////////////////
// GROUP: EN Routes
///////////////////////////
Route::prefix("en")
    ->name("en.")
    ->group(function () {
        // Home: /en
        Route::get("/", function () {
            return view("home");
        })->name("home");

        // Imprint: /en/imprint (this parallels /de/impressum)
        Route::get("/imprint", function () {
            return view("impressum");
        })->name("imprint");

        // Data Protection: /en/data-protection
        Route::get("/data-protection", function () {
            return view("datenschutz");
        })->name("dataProtection");

        // Portfolio: /en/portfolio
        Route::get("/portfolio", [PortfolioController::class, "list"])->name(
            "portfolio"
        );

        // Contact (Form): /en/contact
        Route::get("/contact", [ContactController::class, "form"])->name(
            "contactForm"
        );

        // Contact (Submit): /en/contact/submit
        Route::post("/contact/submit", [
            ContactController::class,
            "submit",
        ])->name("contactSubmit");

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

        Route::middleware(["tester"])->group(function () {
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
        Route::get("/teams", [TeamsController::class, "index"])->name("teams");
    });

///////////////////////////
// OPTIONAL: Default Redirect
///////////////////////////
// If someone goes to / (root), do you want to redirect them to /en or /de, etc.?
Route::get("/", function () {
    return redirect("/en");
});

require base_path("/routes/private.php");
