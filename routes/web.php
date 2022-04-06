<?php

use Illuminate\Support\Facades\Route;

// Home
Route::view('/', 'home')->name('home');

// make an order
Route::get('/order/step-1', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('order.step-1');
Route::get('/order/step-2', [App\Http\Controllers\Client\OrderController::class, 'time'])->name('order.step-2');
Route::get('/order/step-3', [App\Http\Controllers\Client\OrderController::class, 'client'])->name('order.step-3');
Route::get('/order/{order:no_reg}/invoice', App\Http\Controllers\OrderInvoiceController::class)->name('order.invoice');
Route::get('/order/{order:no_reg}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('order.show');


Route::middleware(['auth'])->group(function () {

    // Client...
    Route::get('/me', [App\Http\Controllers\HomeController::class, 'show'])->name('me');
    Route::get('/profile', [App\Http\Controllers\Client\ProfileController::class, 'show'])->name('client.profile');
    Route::get('/profile/edit', [App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('client.profile.edit');
    Route::get('/history', [App\Http\Controllers\Client\OrderHistoryController::class, 'show'])->name('client.history');
    Route::get('/addresses', App\Http\Livewire\Client\ManageAddresses::class)->name('client.addresses');
    Route::get('/families', App\Http\Livewire\Client\ManageFamilies::class)->name('client.families');
    Route::get('/change-password', App\Http\Livewire\Client\ChangePassword::class)->name('client.change-password');

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard');

    // Midwife...
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'show'])->name('calendar');
    Route::get('/orders/create', [App\Http\Controllers\OrdersController::class, 'create'])->name('orders.create');
    Route::get('/orders/{order}', [App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
    Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
    Route::get('/timetables', [App\Http\Controllers\TimetableController::class, 'index'])->name('timetables');

    // Admin...
    Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])->name('payments');
    Route::get('/testimonials', [App\Http\Controllers\TestimonialsController::class, 'index'])->name('testimonials');
    Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications');
    Route::get('/clients/{client}/edit', [App\Http\Controllers\ClientsController::class, 'edit'])->name('clients.edit');
    Route::get('/clients/create', [App\Http\Controllers\ClientsController::class, 'create'])->name('clients.create');
    Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients');
    Route::get('/clients/tags', [App\Http\Controllers\ClientsTagsController::class, 'index'])->name('clients.tags');

    // Owner..
    Route::get('/midwives/{midwife}/edit', [App\Http\Controllers\MidwivesController::class, 'edit'])->name('midwives.edit');
    Route::get('/midwives/create', [App\Http\Controllers\MidwivesController::class, 'create'])->name('midwives.create');
    Route::get('/midwives', [App\Http\Controllers\MidwivesController::class, 'index'])->name('midwives');
    Route::get('/treatments', [App\Http\Controllers\TreatmentsController::class, 'index'])->name('treatments');
    Route::get('/treatments/categories', [App\Http\Controllers\TreatmentCategoriesController::class, 'show'])->name('categories');
    Route::get('/wilayah', [App\Http\Controllers\KecamatanController::class, 'index'])->name('wilayah');
    Route::get('/wilayah/kabupaten', [App\Http\Controllers\KabupatenController::class, 'show'])->name('kabupaten');
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'show'])->name('settings');

    Route::prefix('admin')->name('admin')->group(function(){
        //
    });

});

require __DIR__.'/auth.php';
