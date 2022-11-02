<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.welcome');
});

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
