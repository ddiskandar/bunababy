<?php

use App\Http\Controllers\OrderInvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/laravel/login', '/admin/login')->name('login');

Route::middleware(['auth'])->group(function() {
    Route::get('/invoice/{order}/print', OrderInvoiceController::class)->name('order.invoice.print');
});
