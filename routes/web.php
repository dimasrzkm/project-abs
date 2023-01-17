<?php

use App\Models\Receipt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('pages.guest.welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');
    Route::get('/categories', function () {
        return view('pages.admin.categories');
    })->name('categories');
    Route::get('/stocks', function () {
        return view('pages.admin.stocks');
    })->name('stocks');
    Route::get('/pembukuan', function () {
        return view('pages.admin.pembukuan');
    })->name('pembukuan');
    Route::get('/products', function () {
        return view('pages.admin.products');
    })->name('products');
    Route::get('/orders', function () {
        return view('pages.admin.orders');
    })->name('orders');
    Route::get('/receipts/{receipt:name_file}', function (Receipt $receipt) {
        return Storage::response('public/pdf/'.$receipt->name_file);
    });

    Route::get('/users', function () {
        return view('pages.admin.users');
    })->name('users');

});

require __DIR__.'/auth.php';
