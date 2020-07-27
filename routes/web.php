<?php


/** Set default language to Arabic for Website **/
Route::get('/', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), route('home'));
        session(['lang' => \App::getLocale()]);
        return Redirect::to($url);
});
Route::get('/ar', function () {
    \LaravelLocalization::setLocale('ar');
    $url = \LaravelLocalization::getLocalizedURL(\App::getLocale(), route('home'));
        session(['lang' => \App::getLocale()]);
        return Redirect::to($url);
});
Route::get('/en', function () {
    \LaravelLocalization::setLocale('en');
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


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    session(['lang' => \App::getLocale()]);

    /* ADMIN */

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
            // Route::resource('methods', 'Admin\PaymentMethodsController');
            // Route::post('delete_method', 'Admin\PaymentMethodsController@deleteMethod')->name('methods.delete');

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

            // Banks
            Route::resource('banks', 'Admin\BankController');
            Route::post('delete_bank', 'Admin\BankController@deleteBank')->name('banks.delete');

            // Addresses
            Route::get('get_addresses', 'Admin\AddressesController@index')->name('addresses.get_all');

            // Orders
            Route::get('orders', 'Admin\OrderController@index')->name('orders.index');
            Route::get('orders/{id}', 'Admin\OrderController@show')->name('orders.show');
            Route::post('orders', 'Admin\OrderController@update')->name('orders.update');

            // Contacts
            Route::get('contacts', 'Admin\ContactsController@index')->name('contacts.index');
            Route::post('delete_contacts', 'Admin\ContactsController@deleteContacts')->name('contacts.delete');
            
            // Users
            Route::resource('users', 'Admin\UserController');
            Route::get('delete_user', 'Admin\UserController@deleteUser')->name('users.delete');
            Route::get('subscribers', 'Admin\UserController@getSubScripers')->name('users.subscripers');
            Route::post('delete_subscribers', 'Admin\UserController@deleteSubScripers')->name('subscripers.delete');
        });

        //Get cities
        Route::post('get_cities', 'Admin\CountryController@getCities')->name('countries.getCities');
    });















    /* WEBSITE */

    Auth::routes();

    // Register
    Route::get('register_user/{role_id}', 'Web\RegisterController@getRegisterForm')->name('register.form');
    Route::post('register_user/{role_id}', 'Web\RegisterController@register')->name('register.user');
    Route::post('verify', 'Web\RegisterController@verify')->name('register.verify');
    Route::post('resend_code', 'Web\RegisterController@resendCode')->name('register.resend_code');

    // Login
    Route::get('login_user', 'Web\LoginController@getLoginForm')->name('login.form');
    Route::post('login_user', 'Web\LoginController@loginUser')->name('login.user');

    // Home
    Route::get('/home', 'HomeController@index')->name('home');

    // Educational Bags
    Route::get('/categories/{id}', 'Web\BagCategoryController@show')->name('categories.bags');
    Route::get('/bags', 'Web\BagController@index')->name('bags');
    Route::get('/bags/{id}', 'Web\BagController@show')->name('bags.show');

    //Jobs
    Route::get('web_jobs', 'Web\JobsController@index')->name('jobs.web_index');
    Route::get('web_jobs/{id}', 'Web\JobsController@show')->name('jobs.details');
    Route::get('web_jobs/apply/{job_id}', 'Web\JobsController@applyToJob')->name('jobs.apply');
    Route::post('web_jobs/apply', 'Web\JobsController@updateSeekerData')->name('jobs.update_seeker');
    Route::post('web_jobs/save', 'Web\JobsController@saveJob')->name('jobs.save');

    // Teachers
    Route::get('teachers', 'Web\TeachersController@index')->name('teachers.index');
    Route::get('teachers/{id}', 'Web\TeachersController@show')->name('teachers.show');
    Route::get('get_teachers/{type}', 'Web\TeachersController@getTeachersByType')->name('teachers.get_by_type');

    // Static pages
    Route::get('/pages/{page}', 'Web\StaticPagesController@getPage')->name('pages');
    Route::post('subscribe', 'Web\StaticPagesController@subscribe')->name('users.subscribe');

    // Contact us
    Route::get('/contact_us','Web\StaticPagesController@getContactUs')->name('contact_us');
    Route::post('/contact_us','Web\StaticPagesController@storeContactUs')->name('contact_us.store');

    Route::group(['middleware' => ['auth:web']], function(){

        // Cart
        Route::get('carts', 'Web\CartController@index')->name('carts.index');
        Route::post('carts', 'Web\CartController@store')->name('carts.store');
        Route::put('carts/update', 'Web\CartController@update')->name('carts.update');
        Route::delete('cart/delete', 'Web\CartController@delete')->name('carts.delete');

        // Orders
        Route::get('payment/{address_id}', 'Web\PaymentController@prepareOrder')->name('payment.prepare_order');
        Route::get('banks_data', 'Web\PaymentController@getBanksData')->name('payment.banks');
        Route::post('save_bank_receipt', 'Web\PaymentController@saveBankReceipt')->name('payment.bank_receipt');
        Route::get('confirm_order/{id}', 'Web\PaymentController@confirmOrder')->name('order.confirm');

        // Addresses
        Route::get('addresses/index', 'Web\AddressController@index')->name('addresses.index');
        Route::post('addresses', 'Web\AddressController@store')->name('addresses.store');
        Route::delete('addresses', 'Web\AddressController@delete')->name('addresses.delete');

        // Profile
        Route::get('profile', 'Web\ProfileController@index')->name('profile.index');
        Route::get('saved', 'Web\ProfileController@getSaved')->name('saved.index');
        Route::get('personal_info', 'Web\ProfileController@editPersonalInfo')->name('profile.edit_personal_info');
        Route::post('personal_info', 'Web\ProfileController@storePersonalInfo')->name('profile.store_personal_info');
        Route::get('get_orders', 'Web\ProfileController@getOrders')->name('profile.orders');
        Route::get('get_orders/{id}', 'Web\ProfileController@trackOrder')->name('profile.track_order');
        Route::get('contents/{id}', 'Web\ProfileController@showBagContents')->name('order.bag_contents');
    });

});