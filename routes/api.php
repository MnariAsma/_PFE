<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\CoproprieteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImmobilierController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SyndicatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthController::class, 'login']);
Route::get('users', [UserController::class, 'index']);
Route::post('register', [AuthController::class, 'register']);

// Route::middleware(['auth:sanctum'])->group(function () {
//     // Route::middleware(['auth:resident'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// // });
// })->middleware(['admin','resident']);

Route::middleware(['auth:sanctum'])->group(function () {                                                                      //il manque le controle selon le role j'ai un probleme pour le superAdmin
    Route::controller(SyndicatController::class)->group(function () {
        Route::get('syndicats', 'index');//ok
        Route::post('syndicats', 'store');//
        Route::get('syndicats/{id}', 'show');//ok
        Route::put('syndicats/{id}', 'update');//ok
        Route::delete('syndicats/{id}', 'destroy');//ok
    });
    Route::controller(ImmobilierController::class)->group(function () {
        Route::get('immobiliers', 'index');//ok
        Route::post('immobiliers', 'store');//ok
        Route::get('immobiliers/{id}', 'show');//ok
        Route::put('immobiliers/{id}', 'update');//ok
        Route::delete('immobiliers/{id}', 'destroy');//ok
    });
    Route::controller(AppartementController::class)->group(function () {
        Route::get('appartements', 'index');//ok
        Route::post('appartements', 'store');//ok
        Route::get('appartements/{id}', 'show');//ok
        Route::put('appartements/{id}', 'update');//ok
        Route::delete('appartements/{id}', 'destroy');//ok
    });
    Route::controller(EventController::class)->group(function () {
        Route::get('events', 'index');//ok
        Route::post('events', 'store');//ok
        Route::get('events/{id}', 'show');//ok
        Route::put('events/{id}', 'update');//ok
        Route::delete('events/{id}', 'destroy');//ok
    });
    Route::controller(CoproprieteController::class)->group(function () {
        Route::get('coproprietes', 'index');//ok
        Route::post('coproprietes', 'store');//ok
        Route::get('coproprietes/{id}', 'show');//ok
        Route::put('coproprietes/{id}', 'update');//ok
        Route::delete('coproprietes/{id}', 'destroy');//ok
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index');//ok
        Route::post('services', 'store');//ok
        Route::get('services/{id}', 'show');//ok
        Route::put('services/{id}', 'update');//ok
        Route::delete('services/{id}', 'destroy');//ok
    });
    Route::controller(ContributionController::class)->group(function () {
        Route::get('contributions', 'index');//ok
        Route::post('contributions', 'store');//ok
        Route::get('contributions/{id}', 'show');//ok
        Route::put('contributions/{id}', 'update');//ok
        Route::delete('contributions/{id}', 'destroy');//ok
    });
    Route::controller(DepenseController::class)->group(function () {
        Route::get('depenses', 'index');//ok
        Route::post('depenses', 'store');//ok
        Route::get('depenses/{id}', 'show');//ok
        Route::put('depenses/{id}', 'update');//ok
        Route::delete('depenses/{id}', 'destroy');//ok
    });
    Route::post("SendMessage", [ChatController::class, "SendMessage"]);
    Route::get("load", [MessageController::class, "LoadThePreviousMessages"]);
    
    Route::post('/logout', [AuthController::class, 'logout']);

});

// Route::middleware(['auth:sanctum', 'resident'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });