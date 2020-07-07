<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'lang'], function(){

    // Static pages
    Route::get('rules_conditions', 'Api\StaticPagesController@getRulesAndConditions');
    Route::get('policy', 'Api\StaticPagesController@getPolicy');
    Route::get('help_center', 'Api\StaticPagesController@getHelpCenter');
    Route::get('about_us', 'Api\StaticPagesController@getAboutUs');

    // Register
    Route::post('regiter', 'Api\RegisterController@register');
    Route::post('verify', 'Api\RegisterController@verify');
    Route::post('resend_code', 'Api\RegisterController@resendCode');

    // Login
    Route::post('login', 'Api\LoginController@login');
    Route::post('logout', 'Api\LoginController@logout');

    // Reset password
    Route::post('reset', 'Api\ResetPasswordController@reset');
    Route::post('verify_email_to_reset', 'Api\ResetPasswordController@verifyEmailToReset');
    Route::post('set_new_password', 'Api\ResetPasswordController@setNewPassword');

    // Home
    Route::get('home', 'Api\HomeController@index');

    // Contact us
    Route::get('contact_us', 'Api\ContactUsController@index');
    Route::post('contact_us', 'Api\ContactUsController@store');

    // Auth routes
    Route::group(['middleware' => 'auth:api'], function(){

        // Addresses
        Route::post('addresses', 'Api\AddressController@store');
        Route::get('countries', 'Api\AddressController@getCountries');

    });
    
});

