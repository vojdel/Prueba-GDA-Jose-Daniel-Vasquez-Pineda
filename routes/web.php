<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [RegisterController::class, 'login'])->name('login')->middleware('auth:sanctum');
