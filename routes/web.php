<?php

use Illuminate\Support\Facades\Route;

// Home
Route::get('/', App\Http\Controllers\HomeController::class)
        ->name('home');

// Create new order by client
Route::get('/order/create', [App\Http\Controllers\Client\OrderController::class, 'create'])
        ->name('order.create');
Route::get('/order/cart', App\Http\Controllers\Client\OrderCartController::class)
        ->name('order.cart');
Route::get('/order/check', App\Http\Controllers\Client\OrderCheckController::class)
        ->name('order.check');
Route::get('/order/checkout', App\Http\Controllers\Client\OrderCheckoutController::class)
        ->name('order.checkout');

Route::middleware(['auth'])->group(function () {

    Route::get('/invoice/{order}', App\Http\Controllers\OrderInvoiceController::class)
            ->name('order.invoice');
    Route::get('/reservation/{order}', [App\Http\Controllers\Client\OrderController::class, 'show'])
            ->name('order.show');

    // Client...
    Route::middleware(['client'])->group(function () {
        Route::get('/profile', [App\Http\Controllers\Client\ProfileController::class, 'show'])
                ->name('client.profile');
        Route::get('/profile/edit', [App\Http\Controllers\Client\ProfileController::class, 'edit'])
                ->name('client.profile.edit');
        Route::get('/history', [App\Http\Controllers\Client\OrderHistoryController::class, 'show'])
                ->name('client.history');
        Route::get('/notification', App\Http\Livewire\Client\ClientNotifications::class)
                ->name('client.notifications');
        Route::get('/addresses', App\Http\Livewire\Client\ManageAddresses::class)
                ->name('client.addresses');
        Route::get('/families', App\Http\Livewire\Client\ManageFamilies::class)
                ->name('client.families');
        Route::get('/change-password', App\Http\Livewire\Client\ChangePassword::class)
                ->name('client.change-password');
        Route::get('/reservation/{order}/testimonial', [App\Http\Controllers\TestimonialsController::class, 'show'])
                ->name('client.testimonial');
    });

    // Dashboard
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class)
            ->name('dashboard');

    // Owner..
    Route::middleware(['owner'])->group(function () {
        Route::get('/midwives/create', [App\Http\Controllers\MidwivesController::class, 'create'])
                ->can('manage-midwives')
                ->name('midwives.create');
        Route::get('/midwives/{midwife}/edit', [App\Http\Controllers\MidwivesController::class, 'edit'])
                ->can('manage-midwives')
                ->name('midwives.edit');
        Route::get('/midwives', [App\Http\Controllers\MidwivesController::class, 'index'])
                ->can('manage-midwives')
                ->name('midwives');
        Route::get('/treatments', App\Http\Controllers\TreatmentsController::class)
                ->can('manage-treatments')
                ->name('treatments');
        Route::get('/treatments/categories', App\Http\Controllers\TreatmentCategoriesController::class)
                ->can('manage-treatments')
                ->name('categories');
        Route::get('/places', [App\Http\Controllers\PlaceController::class, 'index'])
                ->can('manage-places')
                ->name('places');
        Route::get('/places/{place}/edit', [App\Http\Controllers\PlaceController::class, 'edit'])
                ->can('manage-places')
                ->name('places.edit');
        Route::get('/wilayah', App\Http\Controllers\KecamatanController::class)
                ->can('manage-wilayah')
                ->name('wilayah');
        Route::get('/wilayah/kabupaten', App\Http\Controllers\KabupatenController::class)
                ->can('manage-wilayah')
                ->name('kabupaten');
        Route::get('/settings', App\Http\Controllers\SettingController::class)
                ->can('manage-settings')
                ->name('settings');
    });

    // Admin...
    Route::middleware(['admin'])->group(function () {
        Route::get('/orders/create', [App\Http\Controllers\OrdersController::class, 'create'])
                ->name('orders.create');
        Route::get('/notifications', [App\Http\Controllers\NotificationsController::class, 'index'])
                ->can('manage-notifications')
                ->name('notifications');
        Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'show'])
                ->can('view-calendar')
                ->name('calendar');
        Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])
                ->can('manage-payments')
                ->name('payments');
        Route::get('/testimonials', [App\Http\Controllers\TestimonialsController::class, 'index'])
                ->can('manage-testimonials')
                ->name('testimonials');
        Route::get('/clients/tags', [App\Http\Controllers\ClientsTagsController::class, 'show'])
                ->can('manage-clients')
                ->name('clients.tags');
        Route::get('/clients/create', [App\Http\Controllers\ClientsController::class, 'create'])
                ->can('manage-clients')
                ->name('clients.create');
        Route::get('/clients/{client}', [App\Http\Controllers\ClientsController::class, 'show'])
                ->can('manage-clients')
                ->name('clients.show');
        Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])
                ->can('manage-clients')
                ->name('clients');
    });

    Route::middleware(['midwife'])->group(function () {
        Route::get('/orders/{order}', [App\Http\Controllers\OrdersController::class, 'show'])
                ->name('orders.show');
        Route::get('/orders', [App\Http\Controllers\OrdersController::class, 'index'])
                ->name('orders');
        Route::get('/timetables', App\Http\Controllers\TimetableController::class)
                ->name('timetables');
        Route::get('/user/profile', App\Http\Controllers\UserProfileController::class)
                ->name('user.profile');
    });
});

require __DIR__ . '/auth.php';
