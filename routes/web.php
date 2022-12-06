<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.guest.welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');
    Route::get('/categories', function () {
        return view('pages.admin.categories');
    })->name('categories');
    Route::get('/stocks', function () {
        return view('pages.admin.stocks');
    })->name('stocks');
});

require __DIR__.'/auth.php';
