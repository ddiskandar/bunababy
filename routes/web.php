<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\ManageTreatments;
use App\Http\Livewire\Client\ChangePassword;
use App\Http\Livewire\Client\ClientHistory;
use App\Http\Livewire\Client\EditClientProfile;
use App\Http\Livewire\Client\ManageAddresses;
use App\Http\Livewire\Client\ManageFamilies;
use Illuminate\Support\Facades\Route;

// Home
Route::view('/', 'home')->name('home');

// make an order
Route::get('/order/step-1', [OrderController::class, 'index'])->name('order.step-1');
Route::get('/order/step-2', [OrderController::class, 'time'])->name('order.step-2');
Route::get('/order/step-3', [OrderController::class, 'client'])->name('order.step-3');
Route::get('/order/{order:no_reg}/invoice', InvoiceController::class)->name('order.invoice');
Route::get('/order/{order:no_reg}', [OrderController::class, 'show'])->name('order.show');


Route::middleware(['auth'])->group(function () {

    // Client
    Route::get('/me', [HomeController::class, 'show'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', EditClientProfile::class)->name('profile.edit');
    Route::get('/history', ClientHistory::class)->name('history');
    Route::get('/addresses', ManageAddresses::class)->name('addresses');
    Route::get('/families', ManageFamilies::class)->name('families');
    Route::get('/change-password', ChangePassword::class)->name('change-password');

    // Admin
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::prefix('admin')->name('admin')->group(function(){

        Route::view('/calendar', 'admin.calendar')->name('.calendar');
        Route::view('/orders', 'admin.orders')->name('.orders');
        Route::view('/payments', 'admin.payments')->name('.payments');
        Route::view('/testimonials', 'admin.testimonials')->name('.testimonials');
        Route::view('/notifications', 'admin.notifications')->name('.notifications');
        Route::view('/clients', 'admin.clients')->name('.clients');
        Route::view('/midwives', 'admin.midwives')->name('.midwives');
        Route::get('/treatments', ManageTreatments::class)->name('.treatments');
        Route::view('/setting', 'admin.setting')->name('.setting');

    });

});

require __DIR__.'/auth.php';
