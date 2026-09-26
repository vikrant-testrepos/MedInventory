<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.app', 'welcome'], function ($view) {
            $cartCount = Auth::check()
                ? Cart::where('user_id', Auth::id())->sum('quantity')
                : 0;

            $view->with('cartCount', $cartCount);
        });
    }
}
