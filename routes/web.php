<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/search', 'SearchController@index')
    ->name('medicine.search');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', 'AdminController@index')
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Categories
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', 'CategoryController');

    /*
    |--------------------------------------------------------------------------
    | Medicines
    |--------------------------------------------------------------------------
    */

    Route::resource('medicines', 'MedicineController');

    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    Route::resource('orders', 'OrderController');

    Route::get('/orders/create/{medicine}', 'OrderController@create')
        ->name('orders.create.medicine');

    /*
    |--------------------------------------------------------------------------
    | Pharmacies
    |--------------------------------------------------------------------------
    */

    Route::resource('pharmacies', 'PharmacyController');

    Route::post('/pharmacies/{id}/status', 'PharmacyController@updateStatus')
        ->name('pharmacies.status');

    /*
    |--------------------------------------------------------------------------
    | Inventory
    |--------------------------------------------------------------------------
    */

    Route::resource('inventory', 'InventoryController');

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', 'ReportController@index')
        ->name('reports.index');

    Route::get('/reports/print', 'ReportController@print')
        ->name('reports.print');

    /*
    |--------------------------------------------------------------------------
    | Stock History
    |--------------------------------------------------------------------------
    */

    Route::get('/stock-history', 'StockHistoryController@index')
        ->name('stock-history.index');

});


/*
|--------------------------------------------------------------------------
| Pharmacy Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pharmacy'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/pharmacy', 'PharmacyDashboardController@index')
        ->name('pharmacy.dashboard');

    /*
    |--------------------------------------------------------------------------
    | Medicines
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'pharmacy/medicines',
        'Pharmacy\MedicineController'
    )->names([
        'index'   => 'pharmacy.medicines.index',
        'create'  => 'pharmacy.medicines.create',
        'store'   => 'pharmacy.medicines.store',
        'show'    => 'pharmacy.medicines.show',
        'edit'    => 'pharmacy.medicines.edit',
        'update'  => 'pharmacy.medicines.update',
        'destroy' => 'pharmacy.medicines.destroy',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Inventory (Coming Next)
    |--------------------------------------------------------------------------
    */

    // Route::resource(
    //     'pharmacy/inventory',
    //     'Pharmacy\InventoryController'
    // )->names([
    //     'index'   => 'pharmacy.inventory.index',
    //     'create'  => 'pharmacy.inventory.create',
    //     'store'   => 'pharmacy.inventory.store',
    //     'edit'    => 'pharmacy.inventory.edit',
    //     'update'  => 'pharmacy.inventory.update',
    //     'destroy' => 'pharmacy.inventory.destroy',
    // ]);

    /*
    |--------------------------------------------------------------------------
    | Orders (Coming Next)
    |--------------------------------------------------------------------------
    */

    // Route::resource(
    //     'pharmacy/orders',
    //     'Pharmacy\OrderController'
    // )->names([
    //     'index'  => 'pharmacy.orders.index',
    //     'show'   => 'pharmacy.orders.show',
    //     'update' => 'pharmacy.orders.update',
    // ]);

    /*
    |--------------------------------------------------------------------------
    | Reports (Coming Next)
    |--------------------------------------------------------------------------
    */

    // Route::get(
    //     '/pharmacy/reports',
    //     'Pharmacy\ReportController@index'
    // )->name('pharmacy.reports.index');

    /*
    |--------------------------------------------------------------------------
    | My Pharmacy (Coming Next)
    |--------------------------------------------------------------------------
    */

    // Route::get(
    //     '/pharmacy/profile',
    //     'Pharmacy\ProfileController@index'
    // )->name('pharmacy.profile');

    // Route::put(
    //     '/pharmacy/profile',
    //     'Pharmacy\ProfileController@update'
    // )->name('pharmacy.profile.update');

});


/*
|--------------------------------------------------------------------------
| Patient Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:patient'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/patient', 'PatientController@index')
        ->name('patient.dashboard');

    Route::redirect('/home', '/patient');

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    */

    Route::get('/cart', 'CartController@index')
        ->name('cart.index');

    Route::post('/cart', 'CartController@store')
        ->name('cart.store');

    Route::patch('/cart/{id}/increase', 'CartController@increase')
        ->name('cart.increase');

    Route::patch('/cart/{id}/decrease', 'CartController@decrease')
        ->name('cart.decrease');

    Route::delete('/cart/{id}', 'CartController@destroy')
        ->name('cart.destroy');

    /*
    |--------------------------------------------------------------------------
    | Checkout
    |--------------------------------------------------------------------------
    */

    Route::get('/checkout', 'CheckoutController@index')
        ->name('checkout.index');

    Route::post('/checkout', 'CheckoutController@store')
        ->name('checkout.store');

    Route::get('/checkout/success', function () {
        return view('checkout.success');
    })->name('checkout.success');

    /*
    |--------------------------------------------------------------------------
    | My Orders
    |--------------------------------------------------------------------------
    */

    Route::get('/my-orders', 'PatientOrderController@index')
        ->name('patient.orders');

});