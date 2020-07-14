<?php


/** Set default language to Arabic for Website **/
Route::get('/', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), route('home'));
        session(['lang' => \App::getLocale()]);
        return Redirect::to($url);
});

/** Set default language to Arabic for Admin **/
Route::get('/admin/', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), \URL::previous());
        session(['lang' => \App::getLocale()]);
        return Redirect::to($url);
});

/* ADMIN */
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    session(['lang' => \App::getLocale()]);

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


        Route::group(['middleware' => ['admin', 'auth:web']], function(){

            // Home
            Route::get('home', 'Admin\HomeController@index')->name('admin.home');

            // Bag categories
            Route::resource('bag_categories', 'Admin\BagCategoryController');
            Route::post('delete_categories', 'Admin\BagCategoryController@deleteBagCategory')->name('bag_categories.delete');

            // Bags
            Route::resource('bags', 'Admin\BagController');
            Route::post('delete_bags', 'Admin\BagController@deleteBag')->name('bags.delete');
            Route::post('delete_pdf', 'Admin\BagController@deletePDF')->name('bags.delete_pdf');
            Route::post('delete_image', 'Admin\BagController@deleteImage')->name('bags.delete_image');
            Route::post('delete_video', 'Admin\BagController@deleteVideo')->name('bags.delete_video');

            // Stages
            Route::resource('stages', 'Admin\StageController');
            Route::post('delete_stages', 'Admin\StageController@deleteStage')->name('stages.delete');

            // Stages
            Route::resource('materials', 'Admin\MaterialController');
            Route::post('delete_material', 'Admin\MaterialController@deleteMaterial')->name('materials.delete');

            // Jobs
            Route::resource('jobs', 'Admin\JobController');
            Route::post('delete_job', 'Admin\JobController@deleteJob')->name('jobs.delete');

            // Countries
            Route::resource('countries', 'Admin\CountryController');
            Route::post('delete_country', 'Admin\CountryController@deleteCountry')->name('countries.delete');
            Route::post('get_cities', 'Admin\CountryController@getCities')->name('countries.getCities');

            // Cities
            Route::resource('cities', 'Admin\CityController');
            Route::post('delete_city', 'Admin\CityController@deleteCity')->name('cities.delete');

            // Organizations
            Route::resource('organizations', 'Admin\OrganizationController');
            Route::post('delete_organization', 'Admin\OrganizationController@deleteOrganization')->name('organizations.delete');

            // Online teachers
            Route::resource('online_teachers', 'Admin\OnlineTeacherController');
            Route::post('delete_online_teacher', 'Admin\OnlineTeacherController@deleteOnlineTeacher')->name('onlineTeachers.delete');

            // Direct teachers
            Route::resource('direct_teachers', 'Admin\DirectTeacherController');
            Route::post('delete_direct_teacher', 'Admin\DirectTeacherController@deleteDirectTeacher')->name('directTeachers.delete');

            // Job seekers
            Route::resource('seekers', 'Admin\SeekerController');
            Route::post('delete_seeker', 'Admin\SeekerController@deleteSeeker')->name('seekers.delete');

            // CVs
            Route::get('cvs', 'Admin\CVController@index')->name('cvs.index');

            // Job applicants
            Route::resource('applicants', 'Admin\ApplicantsController');
            Route::post('delete_applicant', 'Admin\ApplicantsController@deleteApplicant')->name('applicants.delete');

            // Students
            Route::resource('students', 'Admin\StudentController');
            Route::post('delete_student', 'Admin\StudentController@deleteStudent')->name('students.delete');

            // EduTypes
            Route::resource('edu_types', 'Admin\EduTypeController');
            Route::post('delete_edu_type', 'Admin\EduTypeController@deleteEduType')->name('eduTypes.delete');

            // EduLevels
            Route::resource('edu_levels', 'Admin\EduLevelController');
            Route::post('delete_edu_level', 'Admin\EduLevelController@deleteEduLevel')->name('eduLevels.delete');
            
            // Nationalities
            Route::resource('nationalities', 'Admin\NationalityController');
            Route::post('delete_nationality', 'Admin\NationalityController@deleteNationality')->name('nationalities.delete');

            // Payment methods
            Route::resource('methods', 'Admin\PaymentMethodsController');
            Route::post('delete_method', 'Admin\PaymentMethodsController@deleteMethod')->name('methods.delete');

            // Socials
            Route::resource('socials', 'Admin\SocialController');
            Route::post('delete_social', 'Admin\SocialController@deleteSocial')->name('socials.delete');

            // Sliders
            Route::resource('sliders', 'Admin\SliderController');
            Route::post('delete_slider', 'Admin\SliderController@deleteSlider')->name('sliders.delete');

            // Static pages
            Route::get('static_pages', 'Admin\StaticPagesController@index')->name('static_pages.index');
            Route::get('static_pages/{id}', 'Admin\StaticPagesController@edit')->name('static_pages.edit');
            Route::put('static_pages/{id}', 'Admin\StaticPagesController@update')->name('static_pages.update');
            Route::post('delete_goal', 'Admin\StaticPagesController@deleteGoal')->name('goals.delete');

            // Setting
            Route::get('setting', 'Admin\SettingController@edit')->name('setting.edit');
            Route::post('setting', 'Admin\SettingController@update')->name('setting.update');

            // Announces
            Route::resource('announces', 'Admin\AnnouncController');
            Route::post('delete_announce', 'Admin\AnnouncController@deleteAnnounce')->name('announces.delete');
            
            // Users
            Route::resource('users', 'Admin\UserController');
            Route::get('delete_user', 'Admin\UserController@deleteUser')->name('users.delete');
        });
    });

    /* WEBSITE */

    Auth::routes();

    // Register
    Route::get('register_user/{role_id}', 'Web\RegisterController@getRegisterForm')->name('register.form');

    // Home
    Route::get('/home', 'HomeController@index')->name('home');

    // Educational Bags
    Route::get('/categories/{id}', 'Web\BagCategoryController@show')->name('categories.bags');
    Route::get('/bags', 'Web\BagController@index')->name('bags');
    Route::get('/bags/{id}', 'Web\BagController@show')->name('bags.show');

    // Static pages
    Route::get('/pages/{page}', 'Web\StaticPagesController@aboutUs')->name('pages');

    Route::group(['middleware' => ['admin', 'auth:web']], function(){
    });

});