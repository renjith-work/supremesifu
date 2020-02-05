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

// Initial Routes
Route::get('/home', 'HomeController@index')->name('home');
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