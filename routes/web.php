<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/search', 'SearchController@index')->name('medicine.search');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

    Route::resource('categories', 'CategoryController');
    Route::resource('medicines', 'MedicineController');
    Route::resource('orders', 'OrderController');
    Route::resource('pharmacies', 'PharmacyController');

    Route::get('/orders/create/{medicine}', 'OrderController@create')
        ->name('orders.create.medicine');

    Route::get('/inventory', 'InventoryController@index')
        ->name('inventory.index');

    Route::post('/inventory/{id}', 'InventoryController@update')
        ->name('inventory.update');

    Route::get('/reports', 'ReportController@index')
        ->name('reports.index');

    Route::get('/reports/print', 'ReportController@print')
        ->name('reports.print');
});

/*
|--------------------------------------------------------------------------
| Pharmacy Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pharmacy'])->group(function () {

    Route::get('/pharmacy', 'PharmacyDashboardController@index')
        ->name('pharmacy.dashboard');

});

/*
|--------------------------------------------------------------------------
| Patient Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

    Route::get('/patient', 'PatientController@index')
        ->name('patient.dashboard');

    // Keep old links working
    Route::redirect('/home', '/patient');

    // Cart
    Route::get('/cart', 'CartController@index')->name('cart.index');

    Route::post('/cart', 'CartController@store')
        ->name('cart.store');

    Route::patch('/cart/{id}/increase', 'CartController@increase')
        ->name('cart.increase');

    Route::patch('/cart/{id}/decrease', 'CartController@decrease')
        ->name('cart.decrease');

    Route::delete('/cart/{id}', 'CartController@destroy')
        ->name('cart.destroy');

    // Checkout
    Route::get('/checkout', 'CheckoutController@index')
        ->name('checkout.index');

    Route::post('/checkout', 'CheckoutController@store')
        ->name('checkout.store');

    Route::get('/checkout/success', function () {
    return view('checkout.success');
    })->name('checkout.success');

    // Patient Orders
    Route::get('/my-orders', 'PatientOrderController@index')
    ->name('patient.orders');
    
});