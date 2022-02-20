<?php

use App\Http\Controllers\PlaygroundController;
use App\Models\Slot;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/order', function () {
    return view('client.order.jadwal');
})->name('client.order');

Route::get('/order/2', function () {

    if( session()->missing('order.midwife_user_id')
        OR session()->missing('order.place')
        OR session()->missing('order.kecamatan_id')
        OR session()->missing('order.date')
    ) {
        return redirect()->route('client.order');
    }

    return view('client.order.waktu');

})->name('client.order.2');

Route::get('/order/3', function () {

    if( session()->missing('order.midwife_user_id')
        OR session()->missing('order.place')
        OR session()->missing('order.kecamatan_id')
        OR session()->missing('order.date')
        OR session()->missing('order.start_time_id')
    ) {
        return redirect()->route('client.order');
    }

    return view('client.order.waktu');

})->name('client.order.3');





Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/calendar', function () {
    return view('admin.calendar');
})->middleware(['auth'])->name('calendar');

Route::get('/orders', function () {
    return view('admin.orders');
})->middleware(['auth'])->name('orders');

Route::get('/payments', function () {
    return view('admin.payments');
})->middleware(['auth'])->name('payments');

Route::get('/notifications', function () {
    return view('admin.notifications');
})->middleware(['auth'])->name('notifications');

Route::get('/clients', function () {
    return view('admin.clients');
})->middleware(['auth'])->name('clients');

Route::get('/midwives', function () {
    return view('admin.midwives');
})->middleware(['auth'])->name('midwives');

Route::get('/treatments', function () {
    return view('admin.treatments');
})->middleware(['auth'])->name('treatments');

Route::get('/setting', function () {
    return view('admin.setting');
})->middleware(['auth'])->name('setting');

Route::get('/playground', [PlaygroundController::class, 'index']);

require __DIR__.'/auth.php';
