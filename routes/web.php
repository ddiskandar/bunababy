<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', App\Http\Controllers\HomeController::class)->name('home');

// make an order
Route::get('/order/create', [App\Http\Controllers\Client\OrderController::class, 'create'])->name('order.create');
Route::get('/order/cart', App\Http\Controllers\Client\OrderCartController::class)->name('order.cart');
Route::get('/order/check', App\Http\Controllers\Client\OrderCheckController::class)->name('order.check');
Route::get('/order/checkout', App\Http\Controllers\Client\OrderCheckoutController::class)->name('order.checkout');

Route::middleware(['auth'])->group(function () {

    Route::get('/invoice/{order:no_reg}', App\Http\Controllers\OrderInvoiceController::class)->name('order.invoice');
    Route::get('/reservation/{order:no_reg}', [App\Http\Controllers\Client\OrderController::class, 'show'])->name('order.show');

    // Client...
    Route::middleware(['client'])->group(function () {
        Route::get('/profile', [App\Http\Controllers\Client\ProfileController::class, 'show'])->name('client.profile');
        Route::get('/profile/edit', [App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('client.profile.edit');
        Route::get('/history', [App\Http\Controllers\Client\OrderHistoryController::class, 'show'])->name('client.history');
        Route::get('/notification', App\Http\Livewire\Client\ClientNotifications::class)->name('client.notifications');
        Route::get('/addresses', App\Http\Livewire\Client\ManageAddresses::class)->name('client.addresses');
        Route::get('/families', App\Http\Livewire\Client\ManageFamilies::class)->name('client.families');
        Route::get('/change-password', App\Http\Livewire\Client\ChangePassword::class)->name('client.change-password');
        Route::get('/reservation/{order:no_reg}/testimonial', [App\Http\Controllers\TestimonialsController::class, 'show'])->name('client.testimonial');
    });

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard');

    Route::middleware(['midwife'])->group(function () {
        Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'show'])->name('calendar');
        Route::get('/orders/create', [App\Http\Controllers\OrdersController::class, 'create'])->name('orders.create');
        Route::get('/orders/{order}', [App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
        Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
        Route::get('/timetables', [App\Http\Controllers\TimetableController::class, 'index'])->name('timetables');
        // Route::get('/clinic', [App\Http\Controllers\ClinicController::class, 'index'])->name('clinic');
    });

    // Admin...
    Route::middleware(['admin'])->group(function () {
        Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'index'])->name('notifications');
        Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])->name('payments');
        Route::get('/testimonials', [App\Http\Controllers\TestimonialsController::class, 'index'])->name('testimonials');
        Route::get('/clients/tags', [App\Http\Controllers\ClientsTagsController::class, 'show'])->name('clients.tags');
        Route::get('/clients/create', [App\Http\Controllers\ClientsController::class, 'create'])->name('clients.create');
        Route::get('/clients/{client}', [App\Http\Controllers\ClientsController::class, 'show'])->name('clients.show');
        Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients');
    });

    // Owner..
    Route::middleware(['owner'])->group(function () {
        Route::get('/midwives/create', [App\Http\Controllers\MidwivesController::class, 'create'])->name('midwives.create');
        Route::get('/midwives/{midwife}/edit', [App\Http\Controllers\MidwivesController::class, 'edit'])->name('midwives.edit');
        Route::get('/midwives', [App\Http\Controllers\MidwivesController::class, 'index'])->name('midwives');
        Route::get('/treatments', App\Http\Controllers\TreatmentsController::class)->name('treatments');
        Route::get('/places', [App\Http\Controllers\PlaceController::class, 'index'])->name('places');
        Route::get('/places/{place}/edit', [App\Http\Controllers\PlaceController::class, 'edit'])->name('places.edit');
        Route::get('/treatments/categories', App\Http\Controllers\TreatmentCategoriesController::class)->name('categories');
        Route::get('/wilayah', App\Http\Controllers\KecamatanController::class)->name('wilayah');
        Route::get('/wilayah/kabupaten', App\Http\Controllers\KabupatenController::class)->name('kabupaten');
        Route::get('/settings', App\Http\Controllers\SettingController::class)->name('settings');
        Route::get('/user/profile', App\Http\Controllers\UserProfileController::class)->name('user.profile');
    });
});

require __DIR__ . '/auth.php';
