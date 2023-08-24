<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
/* Front Panel */
Route::prefix('/')->namespace('App\Http\Controllers')->group(function () {
    /* before login */
    /* common */
    Route::match(['get'], '/', 'FrontController@home');
    Route::match(['get'], '/about-us', 'FrontController@aboutUs');
    Route::match(['get'], '/contact-us', 'FrontController@contactUs');
    Route::match(['get'], '/how-it-works', 'FrontController@howItWorks');
    Route::match(['get'], '/blogs', 'FrontController@blogs');
    Route::match(['get'], '/blog-details', 'FrontController@blogDetails');
    Route::match(['get'], 'page/{id}', 'FrontController@page');

    Route::match(['get'], '/mentors', 'FrontController@mentors');
    Route::match(['get'], '/mentor-details', 'FrontController@mentorDetails');
    /* common */
    /* authentication */
    Route::match(['get'], '/mentor-signup', 'MentorController@createStep1')->name('mentor-signup');

    Route::match(['post'], '/mentor-createstep1', 'MentorController@postCreateStep1')->name('mentor-createstep1');

    Route::match(['get', 'post'], '/mentor-signup-2', 'MentorController@mentorSignup2');
    Route::match(['get', 'post'], '/mentor-signup-3', 'MentorController@mentorSignup3');
    Route::match(['get', 'post'], '/mentor-signup-4', 'MentorController@mentorSignup4');
    //After development
    //Route::name('mentor.')->group(function () {

    //Route::get('/mentor/create-step1', [\App\Http\Controllers\MentorController::class, 'createStep1'])->name('mentor-signup');
    //Route::post('mentor/create-step1', [\App\Http\Controllers\MentorController::class, 'postCreateStep1']);

    //});


    Route::match(['get', 'post'], '/student-signup', 'FrontController@studentSignup');
    // Route::match(['get', 'post'], '/signup-otp/{id}', 'FrontController@signupOtp');

    // Route::match(['get', 'post'], '/validate-otp/{id}', 'FrontController@validateOtp');
    // Route::match(['get', 'post'], '/reset-password/{id}', 'FrontController@resetPassword');
    Route::match(['get', 'post'], 'signin', 'FrontController@signin');
    Route::match(['get', 'post'], '/forgot-password', 'FrontController@forgotPassword');
    Route::match(['get', 'post'], '/validate-otp', 'FrontController@validateOtp');
    Route::match(['get', 'post'], '/reset-password', 'FrontController@resetPassword');
    /* authentication */
    /* before login */
    /* after login */
    Route::group(['middleware' => ['user']], function () {
        /* common */
        Route::get('signout', 'FrontController@signout');
        Route::get('dashboard', 'FrontController@dashboard');
        Route::match(['get', 'post'], 'update-profile', 'FrontController@updateProfile');
        Route::match(['get', 'post'], 'change-password', 'FrontController@changePassword');
        /* common */
        /* mentor */

        /* mentor */
        /* student */

        /* student */
    });
    /* after login */
});
/* Front Panel */
/* API */
Route::prefix('/api')->namespace('App\Http\Controllers')->group(function () {
    Route::match(['post'], 'signup', 'ApiController@signup');
    Route::match(['post'], 'validate-signup-otp', 'ApiController@validateSignupOtp');
    Route::match(['get'], 'resend-otp', 'ApiController@resendOtp');
});
/* API */
/* Admin Panel */

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], '/', 'UserController@login');
    Route::match(['get','post'], '/forgot-password', 'UserController@forgotPassword');
    Route::match(['get','post'], '/validateOtp/{id}', 'UserController@validateOtp');
    Route::match(['get','post'], '/changePassword/{id}', 'UserController@changePassword');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'UserController@dashboard');
        Route::get('logout', 'UserController@logout');
        Route::get('email-logs', 'UserController@emailLogs');
        Route::get('login-logs', 'UserController@loginLogs');
        /* setting */
        Route::get('settings', 'UserController@settings');
        Route::post('profile-settings', 'UserController@profile_settings');
        Route::post('general-settings', 'UserController@general_settings');
        Route::post('change-password', 'UserController@change_password');
        Route::post('email-settings', 'UserController@email_settings');
        Route::post('email-template', 'UserController@email_template');
        Route::post('sms-settings', 'UserController@sms_settings');
        Route::post('footer-settings', 'UserController@footer_settings');
        Route::post('seo-settings', 'UserController@seo_settings');
        Route::post('payment-settings', 'UserController@payment_settings');
        /* setting */
        /* access & permission */
        /* module */
        Route::get('module/list', 'ModuleController@list');
        Route::match(['get', 'post'], 'module/add', 'ModuleController@add');
        Route::match(['get', 'post'], 'module/edit/{id}', 'ModuleController@edit');
        Route::get('module/delete/{id}', 'ModuleController@delete');
        Route::get('module/change-status/{id}', 'ModuleController@change_status');
        /* module */
        /* sub users */
        Route::get('sub-user/list', 'SubUserController@list');
        Route::match(['get', 'post'], 'sub-user/add', 'SubUserController@add');
        Route::match(['get', 'post'], 'sub-user/edit/{id}', 'SubUserController@edit');
        Route::get('sub-user/delete/{id}', 'SubUserController@delete');
        Route::get('sub-user/change-status/{id}', 'SubUserController@change_status');
        /* sub users */
        /* give access */
        Route::get('access/list', 'AccessController@list');
        Route::match(['get', 'post'], 'access/add', 'AccessController@add');
        Route::match(['get', 'post'], 'access/edit/{id}', 'AccessController@edit');
        Route::get('access/delete/{id}', 'AccessController@delete');
        Route::get('access/change-status/{id}', 'AccessController@change_status');
        /* give access */
        /* access & permission */
        /* master */
        /* banner */
        Route::get('banner/list', 'BannerController@list');
        Route::match(['get', 'post'], 'banner/add', 'BannerController@add');
        Route::match(['get', 'post'], 'banner/edit/{id}', 'BannerController@edit');
        Route::get('banner/delete/{id}', 'BannerController@delete');
        Route::get('banner/change-status/{id}', 'BannerController@change_status');
        /* banner */
        /* testimonial */
        Route::get('testimonial/list', 'TestimonialController@list');
        Route::match(['get', 'post'], 'testimonial/add', 'TestimonialController@add');
        Route::match(['get', 'post'], 'testimonial/edit/{id}', 'TestimonialController@edit');
        Route::get('testimonial/delete/{id}', 'TestimonialController@delete');
        Route::get('testimonial/change-status/{id}', 'TestimonialController@change_status');
        /* testimonial */
        /* service types */
        Route::get('service-type/list', 'ServiceTypeController@list');
        Route::match(['get', 'post'], 'service-type/add', 'ServiceTypeController@add');
        Route::match(['get', 'post'], 'service-type/edit/{id}', 'ServiceTypeController@edit');
        Route::get('service-type/delete/{id}', 'ServiceTypeController@delete');
        Route::get('service-type/change-status/{id}', 'ServiceTypeController@change_status');
        /* service types */
        /* service */
        Route::get('service/list', 'ServiceController@list');
        Route::match(['get', 'post'], 'service/add', 'ServiceController@add');
        Route::match(['get', 'post'], 'service/edit/{id}', 'ServiceController@edit');
        Route::get('service/delete/{id}', 'ServiceController@delete');
        Route::get('service/change-status/{id}', 'ServiceController@change_status');
        /* service */
        /* service attributes */
        Route::get('service-attribute/list', 'ServiceAttributeController@list');
        Route::match(['get', 'post'], 'service-attribute/add', 'ServiceAttributeController@add');
        Route::match(['get', 'post'], 'service-attribute/edit/{id}', 'ServiceAttributeController@edit');
        Route::get('service-attribute/delete/{id}', 'ServiceAttributeController@delete');
        Route::get('service-attribute/change-status/{id}', 'ServiceAttributeController@change_status');
        /* service attributes */
        /* source */
        Route::get('source/list', 'SourceController@list');
        Route::match(['get', 'post'], 'source/add', 'SourceController@add');
        Route::match(['get', 'post'], 'source/edit/{id}', 'SourceController@edit');
        Route::get('source/delete/{id}', 'SourceController@delete');
        Route::get('source/change-status/{id}', 'SourceController@change_status');
        /* source */
        /* expertise */
        Route::get('expertise/list', 'ExpertiseController@list');
        Route::match(['get', 'post'], 'expertise/add', 'ExpertiseController@add');
        Route::match(['get', 'post'], 'expertise/edit/{id}', 'ExpertiseController@edit');
        Route::get('expertise/delete/{id}', 'ExpertiseController@delete');
        Route::get('expertise/change-status/{id}', 'ExpertiseController@change_status');
        /* expertise */
        /* currency */
        Route::get('currency/list', 'CurrencyController@list');
        Route::match(['get', 'post'], 'currency/add', 'CurrencyController@add');
        Route::match(['get', 'post'], 'currency/edit/{id}', 'CurrencyController@edit');
        Route::get('currency/delete/{id}', 'CurrencyController@delete');
        Route::get('currency/change-status/{id}', 'CurrencyController@change_status');
        /* currency */
        /* language */
        Route::get('language/list', 'LanguageController@list');
        Route::match(['get', 'post'], 'language/add', 'LanguageController@add');
        Route::match(['get', 'post'], 'language/edit/{id}', 'LanguageController@edit');
        Route::get('language/delete/{id}', 'LanguageController@delete');
        Route::get('language/change-status/{id}', 'LanguageController@change_status');
        /* language */
        /* master */
        /* page */
        Route::get('page/list', 'PageController@list');
        Route::match(['get', 'post'], 'page/add', 'PageController@add');
        Route::match(['get', 'post'], 'page/edit/{id}', 'PageController@edit');
        Route::get('page/delete/{id}', 'PageController@delete');
        Route::get('page/change-status/{id}', 'PageController@change_status');
        /* page */
        /* FAQs */
        /* faq */
        Route::get('faq/list', 'FaqController@list');
        Route::match(['get', 'post'], 'faq/add', 'FaqController@add');
        Route::match(['get', 'post'], 'faq/edit/{id}', 'FaqController@edit');
        Route::get('faq/delete/{id}', 'FaqController@delete');
        Route::get('faq/change-status/{id}', 'FaqController@change_status');
        Route::get('faq/change-home-page-status/{id}', 'FaqController@change_home_page_status');
        /* faq */
        /* how it works */
        Route::get('how-it-works/list', 'HowItWorkController@list');
        Route::match(['get', 'post'], 'how-it-works/add', 'HowItWorkController@add');
        Route::match(['get', 'post'], 'how-it-works/edit/{id}', 'HowItWorkController@edit');
        Route::get('how-it-works/delete/{id}', 'HowItWorkController@delete');
        Route::get('how-it-works/change-status/{id}', 'HowItWorkController@change_status');
        Route::get('how-it-works/change-home-page-status/{id}', 'HowItWorkController@change_home_page_status');
        /* how it works */
        /* FAQs */
        /* team */
        Route::get('team/list', 'TeamController@list');
        Route::match(['get', 'post'], 'team/add', 'TeamController@add');
        Route::match(['get', 'post'], 'team/edit/{id}', 'TeamController@edit');
        Route::get('team/delete/{id}', 'TeamController@delete');
        Route::get('team/change-status/{id}', 'TeamController@change_status');
        Route::get('team/change-home-page-status/{id}', 'TeamController@change_home_page_status');
        /* team */
        /* blog */
        /* blog category */
        Route::get('blog-category/list', 'BlogCategoryController@list');
        Route::match(['get', 'post'], 'blog-category/add', 'BlogCategoryController@add');
        Route::match(['get', 'post'], 'blog-category/edit/{id}', 'BlogCategoryController@edit');
        Route::get('blog-category/delete/{id}', 'BlogCategoryController@delete');
        Route::get('blog-category/change-status/{id}', 'BlogCategoryController@change_status');
        /* blog category */
        /* blogs */
        Route::get('blog/list', 'BlogController@list');
        Route::match(['get', 'post'], 'blog/add', 'BlogController@add');
        Route::match(['get', 'post'], 'blog/edit/{id}', 'BlogController@edit');
        Route::get('blog/delete/{id}', 'BlogController@delete');
        Route::get('blog/change-status/{id}', 'BlogController@change_status');
        /* blogs */
        /* blog */
        /* mentor */
        Route::get('mentor/list', 'MentorController@list');
        Route::get('mentor/availability/{id}', 'MentorController@availability');
        Route::get('mentor/assigned-services/{id}', 'MentorController@assignedServices');
        Route::get('mentor/bookings/{id}', 'MentorController@bookings');
        Route::get('mentor/transactions/{id}', 'MentorController@transactions');
        Route::get('mentor/payouts/{id}', 'MentorController@payouts');
        Route::get('mentor/delete/{id}', 'MentorController@delete');
        Route::get('mentor/change-status/{id}', 'MentorController@change_status');
        /* mentor */
        /* student */
        Route::get('student/list', 'StudentController@list');
        Route::get('student/bookings/{id}', 'StudentController@bookings');
        Route::get('student/transactions/{id}', 'StudentController@transactions');
        Route::get('student/delete/{id}', 'StudentController@delete');
        Route::get('student/change-status/{id}', 'StudentController@change_status');
        /* student */
        /* survey */
        /* question type */
        Route::get('question-type/list', 'QuestionTypeController@list');
        Route::match(['get', 'post'], 'question-type/add', 'QuestionTypeController@add');
        Route::match(['get', 'post'], 'question-type/edit/{id}', 'QuestionTypeController@edit');
        Route::get('question-type/delete/{id}', 'QuestionTypeController@delete');
        Route::get('question-type/change-status/{id}', 'QuestionTypeController@change_status');
        /* question type */
        /* grade */
        Route::get('grade/list', 'GradeController@list');
        Route::match(['get', 'post'], 'grade/add', 'GradeController@add');
        Route::match(['get', 'post'], 'grade/edit/{id}', 'GradeController@edit');
        Route::get('grade/delete/{id}', 'GradeController@delete');
        Route::get('grade/change-status/{id}', 'GradeController@change_status');
        /* grade */
        /* survey */
        Route::get('survey/list', 'SurveyController@list');
        Route::match(['get', 'post'], 'survey/add', 'SurveyController@add');
        Route::match(['get', 'post'], 'survey/edit/{id}', 'SurveyController@edit');
        Route::get('survey/delete/{id}', 'SurveyController@delete');
        Route::get('survey/change-status/{id}', 'SurveyController@change_status');
        Route::match(['get', 'post'], 'survey/grade/{id}', 'SurveyController@grade');
        Route::match(['get', 'post'], 'survey/edit-grade/{id}', 'SurveyController@edit_grade');
        /* survey */
        /* survey */
        /* bookings */
        Route::get('bookings/list', 'BookingController@list');
        /* bookings */
        /* transactions */
        Route::get('transactions/list', 'TransactionController@list');
        /* transactions */
    });
});


/* Admin Panel */
/* Front Panel */

/* Front Panel */
