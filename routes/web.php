<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\FlightsController;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\ReservationsController;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
const PAGINATION = 25;
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Auth::routes(['register' => false]);
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin
    Route::get('admins/{pagination?}', [AdminsController::class, 'index'])->name('admin.showAll');
    Route::get('admin/add', [AdminsController::class, 'add'])->name('admin.add');
    Route::post('admin/store', [AdminsController::class, 'store'])->name('admin.store');
    Route::get('admin/edit/{admin_id}', [AdminsController::class, 'edit'])->name('admin.edit');
    Route::post('admin/update', [AdminsController::class, 'update'])->name('admin.update');
    Route::get('admin/delete/{admin_id}', [AdminsController::class, 'delete'])->name('admin.delete');
    Route::get('admin/filter/{data}/{pagination?}', [AdminsController::class, 'filter'])->name('admin.fiter');

    // Customer
    Route::get('customer/{pagination?}', [CustomersController::class, 'index'])->name('customer.showAll');
    Route::get('customer/add', [CustomersController::class, 'add'])->name('customer.add');
    Route::post('customer/store', [CustomersController::class, 'store'])->name('customer.store');
    Route::get('customer/edit/{customer_id}', [CustomersController::class, 'edit'])->name('customer.edit');
    Route::post('customer/update', [CustomersController::class, 'update'])->name('customer.update');
    Route::get('customer/delete/{customer_id}', [CustomersController::class, 'delete'])->name('customer.delete');
    Route::get('customer/filter/{data}/{pagination?}', [CustomersController::class, 'filter'])->name('customer.fiter');

    // Hotel
    Route::get('hotels/{pagination?}', [HotelsController::class, 'index'])->name('hotel.showAll');
    Route::get('hotel/add', [HotelsController::class, 'add'])->name('hotel.add');
    Route::post('hotel/store', [HotelsController::class, 'store'])->name('hotel.store');
    Route::get('hotel/edit/{hotel_id}', [HotelsController::class, 'edit'])->name('hotel.edit');
    Route::post('hotel/update', [HotelsController::class, 'update'])->name('hotel.update');
    Route::get('hotel/delete/{hotel_id}', [HotelsController::class, 'delete'])->name('hotel.delete');
    Route::get('hotel/filter/{data}/{pagination?}', [HotelsController::class, 'filter'])->name('hotel.fiter');

    // Reservation
    Route::get('reservations/{pagination?}', [ReservationsController::class, 'index'])->name('reservation.showAll');
    Route::get('reservation/add', [ReservationsController::class, 'add'])->name('reservation.add');
    Route::post('reservation/store', [ReservationsController::class, 'store'])->name('reservation.store');
    Route::get('reservation/edit/{reservation_id}', [ReservationsController::class, 'edit'])->name('reservation.edit');
    Route::post('reservation/update', [ReservationsController::class, 'update'])->name('reservation.update');
    Route::get('reservation/delete/{reservation_id}', [ReservationsController::class, 'delete'])->name('reservation.delete');
    Route::get('reservation/filter/{data}/{pagination?}', [ReservationsController::class, 'filter'])->name('reservation.fiter');

    // Flight
    Route::get('flights/{pagination?}', [FlightsController::class, 'index'])->name('flight.showAll');
    Route::get('flight/add', [FlightsController::class, 'add'])->name('flight.add');
    Route::post('flight/store', [FlightsController::class, 'store'])->name('flight.store');
    Route::get('flight/edit/{flight_id}', [FlightsController::class, 'edit'])->name('flight.edit');
    Route::post('flight/update', [FlightsController::class, 'update'])->name('flight.update');
    Route::get('flight/delete/{flight_id}', [FlightsController::class, 'delete'])->name('flight.delete');
    Route::get('flight/filter/{data}/{pagination?}', [FlightsController::class, 'filter'])->name('flight.fiter');

    // City
    Route::post('/cities/', [CitiesController::class, 'getCities'])->name('get.cities');
});

