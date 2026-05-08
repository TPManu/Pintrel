<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BoardController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('today', 'today')->name('today');
    Route::get('boards', [BoardController::class, 'index'])->name('user-boards');
});

require __DIR__.'/settings.php';
