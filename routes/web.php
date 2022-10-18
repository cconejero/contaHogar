<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardSpendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/cards', [CardController::class, 'store']);

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return Inertia::render('Home');
    });

    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/create', [UserController::class, 'create'])->middleware('can:create,\App\Models\User');
    Route::post('/users', [UserController::class, 'store']);

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

    Route::get('/cards', [CardController::class, 'index']);
    Route::get('/cards/create', [CardController::class, 'create']);
    Route::get('/cards/{card}', [CardController::class, 'show']);

    Route::get('/cards/{card}/spends/create', [CardSpendController::class, 'create']);
    Route::post('/cards/{card}/spends', [CardSpendController::class, 'store']);

});
