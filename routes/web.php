<?php


/** Set default language to Arabic for Website **/
Route::get('/', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
        return Redirect::to($url);
});

/** Set default language to Arabic for Admin **/
Route::get('/admin/', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
        return Redirect::to($url);
});

/* ADMIN */
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::group(['prefix' => 'admin/'], function(){

        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

        // Admin Auth
        Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
        Route::post('login', 'Admin\Auth\LoginController@login');
        Route::post('admin-password/email', 'Admin\Auth\ForgotPasswordController@sendResetSendEmail')->name('admin.password.email');
        Route::get('admin-password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('admin-password/reset', 'Admin\Auth\ResetPasswordController@reset');
        Route::get('admin-password/reset/{email}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
        Route::post('admin-password/update', 'Admin\Auth\ResetPasswordController@update')->name('admin.password.update');

        // Change lang
        Route::get('change_locale/{locale}', 'Admin\HomeController@change_locale')->name('change_locale');

        Route::get('test',function(){
            return View::make('test');
        });


        Route::group(['middleware' => ['admin']], function(){

            // Home
            Route::get('home', 'Admin\HomeController@index')->name('admin.home');

            // Bag categories
            Route::resource('bag_categories', 'Admin\BagCategoryController');

            // Users
            Route::resource('users', 'Admin\UserController');
        });
    });
});



/* WEBSITE */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
