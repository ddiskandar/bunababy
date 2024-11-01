<?php

use App\Http\Controllers\Midwife\DashboardController;
use App\Http\Controllers\OrderInvoiceController;
use Illuminate\Support\Facades\Route;

Route::redirect('/laravel/login', '/admin/login')->name('login');

Route::middleware(['auth'])->group(function() {
    Route::get('/', DashboardController::class)->name('midwife.dashboard');
    Route::get('/invoice/{order}/print', OrderInvoiceController::class)->name('order.invoice.print');
});
