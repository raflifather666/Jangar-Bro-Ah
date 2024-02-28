<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\DashboardController;
use App\http\Controllers\MenuController;
use App\http\Controllers\ChefsController;
use App\http\Controllers\KontakController;
use App\http\Controllers\HomeController;
use App\http\Controllers\ReservationController;
use App\http\Controllers\GalleryController;
use App\Models\Reservation;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::Redirect('/', ('/index'));

Route::get('/index', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('menu', MenuController::class);
Route::resource('chefs', ChefsController::class);
Route::resource('kontak', KontakController::class);
Route::resource('gallery', GalleryController::class);
Route::controller(ReservationController::class)->prefix('reservation')->group(function () {
    Route::get('', 'index')->name('reservation.index');
    Route::post('store', 'store')->name('reservation.store');

});