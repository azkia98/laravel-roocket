<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// roocket.ir/admin
Route::get('/' , 'HomeController@index');
//Route::get('/articles' , 'ArticleController@index');
//Route::get('/courses' , 'CourseController@index');
Route::get('/articles/{articleSlug}' , 'ArticleController@single');
Route::get('/courses/{courseSlug}' , 'CourseController@single');
Route::post('/comment' , 'HomeController@comment');
Route::get('/user/active/email/{token}' , 'UserController@activation')->name('activation.account');
Route::get('/sitemap','SitemapController@index');
Route::get('/sitemap-articles','SitemapController@articles');
Route::get('/feed/article','FeedController@articles');
Route::get('telegram','TelegramController@telegram');
Route::post('/88905215:AAHwtR-_cZd16tcSn_-kKmP8kpM8L-Pik6o/webhook','TelegramController@webhook');



Route::group(['middleware' => 'auth:web'] , function () {
   $this->post('/course/payment' , 'CourseController@payment');
   $this->get('/course/payment/checker' , 'CourseController@checker');
});
// namespace('Admin')->prefix('admin')
Route::group(['namespace' => 'Admin' , 'middleware' => ['auth:web' , 'checkAdmin'], 'prefix' => 'admin'],function (){
    $this->get('/panel' , 'PanelController@index');
    $this->post('/panel/upload-image' , 'PanelController@uploadImageSubject');
    $this->resource('articles' , 'ArticleController');
    $this->resource('courses' , 'CourseController');

    // Comment Section
    $this->get('comments/unsuccessful' , 'CommentController@unsuccessful');
    $this->resource('comments' , 'CommentController');

    // Payment Section
    $this->get('payments/unsuccessful' , 'PaymentController@unsuccessful');
    $this->resource('payments' , 'PaymentController');

    $this->resource('episodes' , 'EpisodeController');
    $this->resource('roles' , 'RoleController');
    $this->resource('permissions' , 'PermissionController');

    $this->group(['prefix' => 'users'],function (){
       $this->get('/' , 'UserController@index');
       $this->resource('level' , 'LevelManageController' , ['parameters' => ['level' => 'user']]);
       $this->delete('/{user}/destroy' , 'UserController@destroy')->name('users.destroy');
    });
});

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login');
    $this->get('logout', 'LoginController@logout')->name('logout');

    // Login And Register With Google
    $this->get('login/google', 'LoginController@redirectToProvider');
    $this->get('login/google/callback', 'LoginController@handleProviderCallback');
    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});


Route::get('/home', 'HomeController@index')->name('home');
