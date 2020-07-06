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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'lang'], function(){

    // Static pages
    Route::get('rules_conditions', 'Api\StaticPagesController@getRulesAndConditions');
    Route::get('policy', 'Api\StaticPagesController@getPolicy');
    Route::get('help_center', 'Api\StaticPagesController@getHelpCenter');

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
});

