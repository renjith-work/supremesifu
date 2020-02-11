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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth Routes
Auth::routes();
Auth::routes(['verify' => true]);

Route::group(['prefix'  =>   'admin', 'as' => 'admin.'], function() {
	// User Routes
	Route::resource('auth/users', 'Admin\Auth\UserController',  ['as' => 'auth']);
	Route::get('auth/users/{id}/delete', 'Admin\Auth\UserController@delete')->name('auth.users.delete');
	// Permission Routes
	Route::resource('auth/permissions', 'Admin\Auth\PermissionController', ['as' => 'auth']);
	Route::get('auth/permissions/{id}/delete', 'Admin\Auth\PermissionController@delete')->name('auth.permissions.delete');
	// Roles Routes
	Route::resource('auth/roles', 'Admin\Auth\RoleController', ['as' => 'auth']);
	Route::get('auth/roles/{id}/delete', 'Admin\Auth\RoleController@delete')->name('auth.roles.delete');
});

Route::get('/register', 'Front\Auth\RegisterController@register')->name('register');
Route::post('/user/register', 'Front\Auth\RegisterController@store')->name('front.auth.user.store');
Route::get('/login', 'Front\Auth\LoginController@login')->name('login');
Route::post('/user/login', 'Front\Auth\LoginController@loginUser')->name('front.auth.user.login');

// Settings Routes
Route::group(['prefix'  =>   'admin', 'as' => 'admin.'], function() {
Route::get('settings', 'Admin\Settings\SettingController@index')->name('settings');
Route::post('settings', 'Admin\Settings\SettingController@update')->name('settings.update');
});

// User Dashboard
Route::group(['prefix'  =>   'user', 'as' => 'user.'], function() {
	Route::get('dashboard','Front\User\DashController@customer')->name('dashboard')->middleware('verified');
	Route::resource('account-details', 'Front\User\AccountController');
	Route::resource('password-reset', 'Front\User\PasswordController');
	Route::get('pasword/reset/email', 'Front\User\PasswordController@forgot');
});

//Socialite
//Google
Route::get('/login/google', 'Front\Auth\LoginController@redirectToGoogle');
Route::get('/login/google/callback', 'Front\Auth\LoginController@handleGoogleCallback');
// Facebook
Route::get('login/facebook', 'Front\Auth\LoginController@redirectToFacebook');
Route::get('login/facebook/callback', 'Front\Auth\LoginController@handleFacebookCallback');

// Email Verification
Route::get('/email-verified', 'Front\Auth\EmailController@verified')->name('verification.redirect');

// Initial Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/test', 'HomeController@test')->middleware('verified');
Route::get('/email', 'HomeController@mail')->name('sendEmail');
Route::get('/dashboard', 'Admin\Dashboard\DashboardController@index')->name('dashboard');


// Blog Post Routes
Route::group(['prefix'  =>   'admin', 'as' => 'admin.'], function() {
	// Post Category Routes
	Route::resource('post/category', 'Admin\Post\CategoryController',  ['as' => 'post']);
	Route::get('post/category/{id}/delete', 'Admin\Post\CategoryController@delete')->name('post.category.delete');
	// Post Tag Routes
	Route::resource('post/tag', 'Admin\Post\TagController',  ['as' => 'post']);
	Route::get('post/tag/{id}/delete', 'Admin\Post\TagController@delete')->name('post.tag.delete');
	// Post Status Routes
	Route::resource('post/status', 'Admin\Post\StatusController',  ['as' => 'post']);
	Route::get('post/status/{id}/delete', 'Admin\Post\StatusController@delete')->name('post.status.delete');
	// Post Routes
	Route::resource('post', 'Admin\Post\PostController');
	Route::get('post/image/delete/{id}/{image}', 'Admin\Post\PostController@imageDel');
});

// Route::get('/admin/post/category', 'Admin\Post\CategoryController@index');