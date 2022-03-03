<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/2', [OrderController::class, 'time'])->name('client.order.2');
Route::get('/order/3', [OrderController::class, 'client'])->name('client.order.3');

Route::middleware(['auth'])->group(function () {

    Route::get('/me', [HomeController::class, 'show'])->name('home');

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::view('/calendar', 'admin.calendar')->name('calendar');
    Route::view('/orders', 'admin.orders')->name('orders');
    Route::view('/payments', 'admin.payments')->name('payments');
    Route::view('/notifications', 'admin.notifications')->name('notifications');
    Route::view('/clients', 'admin.clients')->name('clients');
    Route::view('/midwives', 'admin.midwives')->name('midwives');
    Route::view('/treatments', 'admin.treatments')->name('treatments');
    Route::get('/setting', [SettingController::class, 'show'])->name('setting');

});

require __DIR__.'/auth.php';
