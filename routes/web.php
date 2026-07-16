<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@index');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', 'AdminController@index')
        ->name('admin.dashboard');

    // Categories
    Route::resource('categories', 'CategoryController');

    // Medicines
    Route::resource('medicines', 'MedicineController');

    // Inventory
    Route::get('/inventory', 'InventoryController@index')
        ->name('inventory.index');

    Route::post('/inventory/{id}', 'InventoryController@update')
        ->name('inventory.update');

    // Orders
    Route::resource('orders', 'OrderController');

    // Reports
    Route::get('/reports', 'ReportController@index')
        ->name('reports.index');

    Route::get('/reports/print', 'ReportController@print')
        ->name('reports.print');

    // Pharmacy Management
    Route::resource('pharmacies', 'PharmacyController');

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

    Route::get('/home', 'HomeController@index')
        ->name('home');

});