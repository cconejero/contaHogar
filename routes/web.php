<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountSpendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardSpendController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::post('/cards', [CardController::class, 'store']);
    Route::get('/cards/{card}', [CardController::class, 'show']);

    Route::get('/accounts', [AccountController::class, 'index']);
    Route::get('/accounts/create', [AccountController::class, 'create']);
    Route::post('/accounts', [AccountController::class, 'store']);
    Route::get('/accounts/{account}', [AccountController::class, 'show']);

    Route::get('/accounts/{account}/spends/create', [AccountSpendController::class, 'create']);
    Route::post('/accounts/{account}/spends', [AccountSpendController::class, 'store']);

    Route::get('/cards/{card}/spends/create', [CardSpendController::class, 'create']);
    Route::post('/cards/{card}/spends', [CardSpendController::class, 'store']);

});
