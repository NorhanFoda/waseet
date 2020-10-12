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

// Route::group(['middleware' => ['lang', 'CheckApiTokenExpirationDate']], function(){
    Route::group(['middleware' => ['lang', 'CheckAPI']], function(){

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
    Route::post('api_register/pay', 'Api\RegisterController@StoreRegisterPayment');

    // Countries
    Route::get('countries', 'Api\CountryController@getCountries');
    Route::get('cities', 'Api\CountryController@getCities');
    Route::get('countries/{id}/cities', 'Api\CountryController@getCitiesOfCountry');

    // Login
    Route::post('login', 'Api\LoginController@login')->name('api_user.login');
    Route::post('logout', 'Api\LoginController@logout')->name('api_user.logout');

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

    // Search
    Route::post('search', 'Api\HomeController@search');

    // Banks
    Route::get('banks', 'Api\PaymentController@getBanks');

    // DeviceTokens
    Route::get('tokens', 'Api\DeviceTokensController@index');
    Route::post('tokens', 'Api\DeviceTokensController@create');
    
    // Auth routes
    Route::group(['middleware' => 'auth:api'], function(){

        // Route::get('bag_details/{id}', 'Api\BagCategoryController@getBagDetails');

        // Addresses
        Route::get('user_addresses', 'Api\AddressController@index');
        Route::get('addresses/get', 'Api\AddressController@getAddressesDetails');
        Route::post('addresses/store', 'Api\AddressController@store');
        Route::post('addresses/update', 'Api\AddressController@update');
        Route::delete('addresses/delete', 'Api\AddressController@destroy');

        // Carts
        Route::get('carts', 'Api\CartController@index');
        Route::post('carts', 'Api\CartController@store');
        // Route::post('carts', 'Api\CartController@update');
        // Route::delete('carts', 'Api\CartController@destroy');
        Route::post('carts/update', 'Api\CartController@updateCarts');

        // Payment methods
        Route::get('methods', 'Api\PaymentMethodController@index');

        // Payment
        Route::post('prepare_order', 'Api\PaymentController@prepareOrder');
        Route::post('bank_payment', 'Api\PaymentController@storeBankPayment');
        Route::get('order/{id}/report', 'Api\PaymentController@getOrderReporrt');

        // Orders
        Route::get('orders', 'Api\OrderController@index');
        Route::get('track_order/{order_id}', 'Api\OrderController@trackOrder');
        Route::get('order/bags/{bag_id}', 'Api\OrderController@getBagContents')->name('api_order.bag_contents');

        //Jobs
        Route::get('jobs', 'Api\JobsController@index');
        Route::get('jobs/{id}', 'Api\JobsController@getJobDetails');
        Route::post('jobs/apply', 'Api\JobsController@applyJob');
        Route::get('api_jobs/announce', 'Api\JobsController@announceJobFormData');
        Route::post('jobs/announce', 'Api\JobsController@anounceJob');
        Route::get('api_jobs/announce/{id}', 'Api\JobsController@editAnnounceJobFormData');
        Route::post('jobs/announce/{id}/edit', 'Api\JobsController@editJob');
        Route::get('api_jobs/apply_data/', 'Api\JobsController@applyToJobData');
        Route::get('api_organization/jobs', 'Api\JobsController@getOrganizationJobs');

        // Save
        Route::post('save', 'Api\HomeController@save');

        // Rate
        Route::post('rate', 'Api\HomeController@rate');

        // Teachers
        Route::get('teachers', 'Api\TeacherController@index');
        Route::get('teachers/{id}', 'Api\TeacherController@show');

        // Seekers
        Route::get('api_seekers', 'Api\SeekerController@index');
        Route::get('seekers/{id}', 'Api\SeekerController@getSeekerData');

        // Profile
        Route::get('cv', 'Api\ProfileController@getCV');
        Route::get('saved/all', 'Api\ProfileController@getSavedPosts');
        Route::get('profile/edit', 'Api\ProfileController@getEditPersonalInfoData');
        Route::post('profile/update', 'Api\ProfileController@updatePersonalInfo');
        Route::post('cv/update', 'Api\ProfileController@updateCV');
        Route::post('password/change', 'Api\ProfileController@changePassword');

        // Notificaions
        Route::post('notification', 'Api\NotificationController@enableDisableNotification');
        Route::get('notifications_count', 'Api\NotificationController@getNotificationsCount');
        Route::get('user_notifications', 'Api\NotificationController@getUserNotifications');

    });
    
});

