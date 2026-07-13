<?php

use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Response;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', function () {
    return view('landing.home');
});

Route::get('/midtrans/pay/{pembayaran}', [MidtransController::class, 'pay'])->name('midtrans.pay');

Route::redirect('/login', '/admin/login')->name('login');


