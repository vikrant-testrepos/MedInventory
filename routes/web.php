<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/admin', 'AdminController@index');

    Route::resource('categories', 'CategoryController');

    Route::resource('medicines', 'MedicineController');

    Route::get('/inventory', 'InventoryController@index')->name('inventory.index');

    Route::post('/inventory/{id}', 'InventoryController@update')->name('inventory.update');

    Route::resource('orders', 'OrderController');

    Route::get('/reports', 'ReportController@index')->name('reports.index');

    Route::get('/reports/print', 'ReportController@print')->name('reports.print');
    
});