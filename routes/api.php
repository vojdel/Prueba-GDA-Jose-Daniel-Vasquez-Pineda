<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\CommunesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use Illuminate\Auth\Middleware\Authenticate;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// get regions
Route::get('/regions', [RegionsController::class, 'getRegions']);

// create region
Route::post('/regions', [RegionsController::class, 'createRegion']);

// delete region
Route::delete('/regions/{id}', [RegionsController::class, 'deleteRegion']);

// get communes
Route::get('/communes/{id}', [CommunesController::class, 'getCommunes']);

// create commune
Route::post('/communes', [CommunesController::class, 'createCommune']);

// delete commune
Route::delete('/communes/{id}', [CommunesController::class, 'deleteCommune']);

Route::post('/auth/token', [AuthController::class, 'generateToken']);


Route::middleware(['auth:sanctum', 'ability:check-status,place-orders'])->group(function () {
    // get costumer
    Route::get('/customers/{id}', [CustomersController::class, 'getCustomer']);

    // create customer
    Route::post('/customers', [CustomersController::class, 'createCustomer']);

    // delete customer
    Route::delete('/customers/{id}', [CustomersController::class, 'deleteCustomer']);

    Route::post('/token', [AuthController::class, 'generateToken']);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});
