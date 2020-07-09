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

    // Bag categories
    Route::get('bag_categories', 'Api\BagCategoryController@index');
    Route::get('bags', 'Api\BagCategoryController@getCategoryBags');
    Route::get('bag_details', 'Api\BagCategoryController@getBagDetails');

    // Auth routes
    Route::group(['middleware' => 'auth:api'], function(){

        // Addresses
        Route::get('user_addresses', 'Api\AddressController@index');
        Route::get('addresses', 'Api\AddressController@getAddressesDetails');
        Route::post('addresses', 'Api\AddressController@store');
        Route::put('addresses', 'Api\AddressController@update');
        Route::delete('addresses', 'Api\AddressController@destroy');

        // Carts
        Route::get('carts', 'Api\CartController@index');
        Route::post('carts', 'Api\CartController@store');
        Route::put('carts', 'Api\CartController@update');
        Route::delete('carts', 'Api\CartController@destroy');

        // Payment methods
        Route::get('methods', 'Api\PaymentMethodController@index');

        // Payment
        Route::get('get_payment_form', 'Api\PaymentController@getPaymentForm');
        Route::get('pay_url_api/{order_id}', 'Api\PaymentController@payUrlApi')->name('payUrlApi');

    });
    
});

