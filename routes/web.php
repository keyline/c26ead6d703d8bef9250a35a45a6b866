<?php
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\FrontController;
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

Route::get('/', function () {
    return view('welcome');
});
/* Front Panel */
    // Route::prefix('/')->namespace('App\Http\Controllers')->group(function(){
    //     Route::match(['get'], '/', 'FrontController@home');
    //     Route::match(['get'], 'page/{id}', 'FrontController@page');
    //     Route::match(['get', 'post'], '/signup', 'FrontController@signup');
    //     Route::match(['get', 'post'], '/signup-otp/{id}', 'FrontController@signupOtp');
    //     Route::match(['get', 'post'], '/forgot-password', 'FrontController@forgotPassword');
    //     Route::match(['get', 'post'], '/validate-otp/{id}', 'FrontController@validateOtp');
    //     Route::match(['get', 'post'], '/reset-password/{id}', 'FrontController@resetPassword');
    //     Route::match(['get', 'post'], 'signin', 'FrontController@signin');

    //     Route::group(['middleware' => ['user']], function(){
    //         Route::get('signout', 'FrontController@signout');
    //         Route::get('dashboard', 'FrontController@dashboard');
    //         Route::match(['get', 'post'], 'translate', 'FrontController@translate');
    //         Route::match(['get', 'post'], 'translate-history', 'FrontController@translateHistory');
    //         Route::match(['get', 'post'], 'update-profile', 'FrontController@updateProfile');
    //         Route::match(['get', 'post'], 'change-password', 'FrontController@changePassword');
    //     });
    // });
/* Front Panel */
/* API */
    Route::prefix('/api')->namespace('App\Http\Controllers')->group(function(){
        Route::match(['post'], 'signup', 'ApiController@signup');
        Route::match(['post'], 'validate-signup-otp', 'ApiController@validateSignupOtp');
        Route::match(['get'], 'resend-otp', 'ApiController@resendOtp');
    });    
/* API */
/* Admin Panel */
    Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
        Route::match(['get', 'post'], '/', 'UserController@login');
        Route::group(['middleware' => ['admin']], function(){
            Route::get('dashboard', 'UserController@dashboard');
            Route::get('logout', 'UserController@logout');
            Route::get('settings', 'UserController@settings');
            Route::post('profile-settings', 'UserController@profile_settings');
            Route::post('general-settings', 'UserController@general_settings');
            Route::post('change-password', 'UserController@change_password');
            Route::post('email-settings', 'UserController@email_settings');
            Route::post('sms-settings', 'UserController@sms_settings');
            Route::post('footer-settings', 'UserController@footer_settings');
            Route::post('seo-settings', 'UserController@seo_settings');
            Route::post('payment-settings', 'UserController@payment_settings');
            /* banner */
                Route::get('banner/list', 'BannerController@list');
                Route::match(['get', 'post'], 'banner/add', 'BannerController@add');
                Route::match(['get', 'post'], 'banner/edit/{id}', 'BannerController@edit');
                Route::get('banner/delete/{id}', 'BannerController@delete');
                Route::get('banner/change-status/{id}', 'BannerController@change_status');
            /* banner */
            /* page */
                Route::get('page/list', 'PageController@list');
                Route::match(['get', 'post'], 'page/add', 'PageController@add');
                Route::match(['get', 'post'], 'page/edit/{id}', 'PageController@edit');
                Route::get('page/delete/{id}', 'PageController@delete');
                Route::get('page/change-status/{id}', 'PageController@change_status');
            /* page */
            /* testimonial */
                Route::get('testimonial/list', 'TestimonialController@list');
                Route::match(['get', 'post'], 'testimonial/add', 'TestimonialController@add');
                Route::match(['get', 'post'], 'testimonial/edit/{id}', 'TestimonialController@edit');
                Route::get('testimonial/delete/{id}', 'TestimonialController@delete');
                Route::get('testimonial/change-status/{id}', 'TestimonialController@change_status');
            /* testimonial */
        });
    });
/* Admin Panel */
/* Front Panel */

/* Front Panel */