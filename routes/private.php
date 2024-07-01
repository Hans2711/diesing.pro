<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivateController;
use Illuminate\Support\Facades\Route;


Route::get('/privater-bereich', [PrivateController::class, 'index']);
Route::post('/privater-bereich', [PrivateController::class, 'ReceiveForm']);

Route::get('/notiz/{slug}', [PrivateController::class, 'PublicNote']);

Route::middleware(['private'])->group(function () {
    Route::get('/privater-bereich/notizen', [PrivateController::class, 'notes']);
    Route::get('/privater-bereich/notizen/get/{id}', [PrivateController::class, 'getNote']);
    Route::post('/privater-bereich/notizen/update/{id}', [PrivateController::class, 'updateNote']);
    Route::post('/privater-bereich/notizen/delete/{id}', [PrivateController::class, 'deleteNote']);
});
