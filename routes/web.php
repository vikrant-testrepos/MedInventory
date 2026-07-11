<?php

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/admin', 'AdminController@index')->middleware('auth');