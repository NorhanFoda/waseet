<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use App\Models\StaticPage;
use App\Models\Social;
use App\Models\Country;
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
        session(['lang' => \App::getLocale()]);

        view()->composer('web.layouts.app', function($view){

            $set = Setting::find(1);
            $pages = StaticPage::where('appear_in_footer', 1)->get();
            $socials = Social::all();
            $countries = Country::all();
            $view->with(['set' => $set, 'pages' => $pages, 'socials' => $socials, 
                        'countries' => $countries]);

        });
    }
}
