<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Models\Social;
use App\Models\Country;
use App\Models\Cart;
use DB;

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
        Schema::defaultStringLength(191);

        \App::setLocale('ar');
        \LaravelLocalization::setLocale('ar');
        session(['lang' => \App::getLocale()]);

        view()->composer(['web.layouts.app', 'web.landing'], function($view){

            $set = Setting::find(1);
            $pages = StaticPage::where('appear_in_footer', 1)->get();
            $socials = Social::all();
            $countries = Country::all();
            $carts = auth()->check() ? count(Cart::where('user_id', auth()->user()->id)->get()) : 0;
            $view->with(['set' => $set, 'pages' => $pages, 'socials' => $socials, 
                        'countries' => $countries, 'carts' => $carts]);

        });
    }
}
