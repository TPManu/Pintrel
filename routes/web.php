<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/boards/create', 'boards.create')
    ->middleware('auth')
    ->name('boards.create');

Volt::route('/boards', 'boards.index')
    ->middleware('auth')
    ->name('boards.index');

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
