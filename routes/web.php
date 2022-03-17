<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/order/step-1', [OrderController::class, 'index'])->name('order.step-1');
Route::get('/order/step-2', [OrderController::class, 'time'])->name('order.step-2');
Route::get('/order/step-3', [OrderController::class, 'client'])->name('order.step-3');
Route::get('/order/{order:no_reg}/invoice', InvoiceController::class)->name('order.invoice');

Route::get('/order/{order:no_reg}', [OrderController::class, 'show'])->name('order.show');


Route::middleware(['auth'])->group(function () {

    Route::get('/me', [HomeController::class, 'show'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::view('/calendar', 'admin.calendar')->name('calendar');
    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payments', 'admin.payments')->name('payments');
    Route::view('/notifications', 'admin.notifications')->name('notifications');
    Route::view('/clients', 'admin.clients')->name('clients');
    Route::view('/midwives', 'admin.midwives')->name('midwives');
    Route::view('/treatments', 'admin.treatments')->name('treatments');
    Route::get('/setting', [OptionController::class, 'show'])->name('setting');

});

require __DIR__.'/auth.php';
