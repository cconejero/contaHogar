<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountCycleController;
use App\Http\Controllers\AccountSpendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CardBillingCycleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CardSpendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FixedExpenseController;
use App\Http\Controllers\UserController;
use App\Models\FixedExpense;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

Route::get('login', [LoginController::class, 'create'])->name('login');
//Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate([
        'email' => $googleUser->email,
    ],[
        'name' => $googleUser->name,
        'avatar' => $googleUser->avatar
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return Inertia::render('Home');
    });

//    Route::get('/users', [UserController::class, 'index']);
//    Route::get('/users/create', [UserController::class, 'create'])->middleware('can:create,\App\Models\User');
//    Route::post('/users', [UserController::class, 'store']);

    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/cards', [CardController::class, 'index']);
    Route::get('/cards/create', [CardController::class, 'create']);
    Route::post('/cards', [CardController::class, 'store']);

    Route::get('/billing_cycle/{card_billing_cycle}', [CardBillingCycleController::class, 'show']);
    Route::post('/billing_cycle/{card_billing_cycle}/import', [CardBillingCycleController::class, 'import']);
    Route::get('/billing_cycle/{card_billing_cycle}/paywithaccount/{account}', [CardBillingCycleController::class, 'paywithaccount']);
    Route::get('/billing_cycle/{card_billing_cycle}/close_cycle', [CardBillingCycleController::class, 'closecycle']);

    Route::get('/card_spends/{card_billing_cycle}/create', [CardSpendController::class, 'create']);
    Route::post('/card_spends/{card_billing_cycle}', [CardSpendController::class, 'store']);

    Route::get('/accounts', [AccountController::class, 'index']);
    Route::get('/accounts/create', [AccountController::class, 'create']);
    Route::post('/accounts', [AccountController::class, 'store']);

    Route::get('/account_cycle/{account_cycle}', [AccountCycleController::class, 'show']);

    Route::get('/account_spends/{account_cycle}/create', [AccountSpendController::class, 'create']);
    Route::post('/account_spends/{account_cycle}', [AccountSpendController::class, 'store']);

    Route::get('/fixed_expenses', [FixedExpenseController::class, 'index']);
    Route::get('/fixed_expenses/create', [FixedExpenseController::class, 'create']);
    Route::get('/fixed_expenses/{fixed_expense}/edit', [FixedExpenseController::class, 'edit']);
    Route::get('/fixed_expenses/{fixed_expense}', [FixedExpenseController::class, 'show']);
    Route::post('/fixed_expenses', [FixedExpenseController::class, 'store']);
    Route::patch('/fixed_expenses/{fixed_expense}', [FixedExpenseController::class, 'update']);

});
