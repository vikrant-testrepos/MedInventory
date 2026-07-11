<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/admin', 'AdminController@index');

    Route::resource('categories', 'CategoryController');

    Route::resource('medicines', 'MedicineController');
});