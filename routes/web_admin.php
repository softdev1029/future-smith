<?php

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ert34SeR', 'namespace' => 'Backend'], function () {
	Route::match(['get'], 'login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@showLoginForm']);
	Route::match(['post'], 'login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@login']);
	Route::match(['get', 'post'], 'logout', ['as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);

	Route::get('/', function () {
		return redirect()->route('admin.login');
	});
});

// Auth user
Route::group(['prefix' => 'kpRk3J5QD', 'namespace' => 'Backend', 'middleware' => 'is_admin'], function () {
	Route::get('/', function () {
		return redirect()->route('admin.dashboard');
	});

	Route::match(['get', 'post'], 'dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

	// user
	Route::match(['get', 'post'], 'users', ['as' => 'admin.user.list', 'uses' => 'UserController@index']);
	Route::match(['get', 'post'], 'user/{id}', ['as' => 'admin.user.detail', 'uses' => 'UserController@each']);

	// tribe
	Route::match(['get', 'post'], 'tribes', ['as' => 'admin.tribe.list', 'uses' => 'TribeController@index']);
	Route::match(['get', 'post'], 'tribe/{id}', ['as' => 'admin.tribe.detail', 'uses' => 'TribeController@each']);

	// project
	Route::match(['get', 'post'], 'projects', ['as' => 'admin.project.list', 'uses' => 'ProjectController@index']);
	Route::match(['get', 'post'], 'project/{id}', ['as' => 'admin.project.detail', 'uses' => 'ProjectController@each']);

	// discussions
	Route::match(['get', 'post'], 'discussions', ['as' => 'admin.discussion.list', 'uses' => 'DiscussionController@index']);
	Route::match(['get', 'post'], 'discussion/{id}', ['as' => 'admin.discussion.detail', 'uses' => 'DiscussionController@each']);

	// notification
	Route::match(['get', 'post'], 'notifications', ['as' => 'admin.notification.list', 'uses' => 'NotificationController@index']);
});
