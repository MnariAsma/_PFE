<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\AppartementController;
use App\Http\Controllers\CoproprieteController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImmobilierController;
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
        Route::get('copropriétés', 'index');//ok
        Route::post('copropriétés', 'store');//ok
        Route::get('copropriétés/{id}', 'show');//ok
        Route::put('copropriétés/{id}', 'update');//ok
        Route::delete('copropriétés/{id}', 'destroy');//ok
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('services', 'index');//ok
        Route::post('services', 'store');//ok
        Route::get('services/{id}', 'show');//ok
        Route::put('services/{id}', 'update');//ok
        Route::delete('services/{id}', 'destroy');//ok
    });
    Route::post('/logout', [AuthController::class, 'logout']);

});

// Route::middleware(['auth:sanctum', 'resident'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });