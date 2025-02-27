<?php

use App\Http\Controllers\Expenses\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::middleware(['auth'])->group(function () {
    Route::resource('expenses', ExpenseController::class);
    Route::get('/bookkeeping', [ExpenseController::class, 'index'])->name('bookkeeping.index');
});

require __DIR__.'/auth.php';
