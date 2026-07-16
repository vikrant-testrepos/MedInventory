<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::middleware('auth')->group(function () {

    // Patient Dashboard
    Route::get('/home', 'HomeController@index')->name('home');

    // Admin Dashboard
    Route::get('/admin', 'AdminController@index')->name('admin.dashboard');

    // Categories
    Route::resource('categories', 'CategoryController');

    // Medicines
    Route::resource('medicines', 'MedicineController');

    // Inventory
    Route::get('/inventory', 'InventoryController@index')->name('inventory.index');
    Route::post('/inventory/{id}', 'InventoryController@update')->name('inventory.update');

    // Orders
    Route::resource('orders', 'OrderController');

    // Reports
    Route::get('/reports', 'ReportController@index')->name('reports.index');
    Route::get('/reports/print', 'ReportController@print')->name('reports.print');

    //Pharmacy
    Route::resource('pharmacies', 'PharmacyController');
    Route::get('/pharmacy', 'PharmacyDashboardController@index')->name('pharmacy.dashboard');

    //Patient
    Route::get('/patient', 'PatientController@index')->name('patient.dashboard');

    

});