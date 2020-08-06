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
    Route::get('register_roles', 'Api\RegisterController@getRoles');
    Route::get('register_form/{role}', 'Api\RegisterController@getFromData');
    Route::post('regiter', 'Api\RegisterController@register');
    Route::post('verify', 'Api\RegisterController@verify');
    Route::post('resend_code', 'Api\RegisterController@resendCode');

    // Countries
    Route::get('countries', 'Api\CountryController@getCountries');
    Route::get('cities', 'Api\CountryController@getCities');
    Route::get('countries/{id}/cities', 'Api\CountryController@getCitiesOfCountry');

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
    Route::get('bags/{id}', 'Api\BagCategoryController@getCategoryBags');
    Route::get('bag_details/{id}', 'Api\BagCategoryController@getBagDetails');
    Route::get('api_bags/all', 'Api\BagCategoryController@getAllBags');

    // Jobs
    Route::get('jobs', 'Api\JobsController@index');

    // Teachers
    Route::get('teachers', 'Api\TeacherController@index');

    // Search
    Route::post('search', 'Api\HomeController@search');

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
        // Route::put('carts', 'Api\CartController@update');
        // Route::delete('carts', 'Api\CartController@destroy');

        // Payment methods
        Route::get('methods', 'Api\PaymentMethodController@index');

        // Payment
        Route::get('banks', 'Api\PaymentController@getBanks');
        Route::post('prepare_order', 'Api\PaymentController@prepareOrder');
        Route::post('bank_payment', 'Api\PaymentController@storeBankPayment');
        Route::get('order/{id}/report', 'Api\PaymentController@getOrderReporrt');

        // Orders
        Route::get('orders', 'Api\OrderController@index');
        Route::get('track_order', 'Api\OrderController@trackOrder');

        //Jobs
        Route::get('jobs/{id}', 'Api\JobsController@getJobDetails');
        Route::post('jobs/apply', 'Api\JobsController@applyJob');
        Route::post('jobs/announce', 'Api\JobsController@anounceJob');
        Route::put('jobs/announce/{id}/edit', 'Api\JobsController@editJob');
        Route::post('save', 'Api\JobsController@savePost');

        // Teachers
        Route::get('teachers/{id}', 'Api\TeacherController@show');

        // Profile
        Route::get('cv', 'Api\ProfileController@getCV');
        Route::get('saved/all', 'Api\ProfileController@getSavedPosts');
        Route::put('profile/update', 'Api\ProfileController@updatePersonalInfo');

    });
    
});

