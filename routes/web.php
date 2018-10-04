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

Route::group(['namespace' => 'Frontend'], function () {
	Auth::routes();

	Route::get('/', 'HomeController@index')->name('home');
	Route::get('activate/{token}', ['as' => 'user.activate', 'uses' => 'Auth\RegisterController@activate']);

	Route::group(['middleware' => 'auth'], function () {

		// User
		Route::match(['get', 'post'], 'user/edit', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
		Route::match(['get', 'post'], 'user/memberships', ['as' => 'user.memberships', 'uses' => 'UserController@memberships']);
		Route::match(['get', 'post'], 'user/invites', ['as' => 'user.invites', 'uses' => 'UserController@invites']);
		Route::match(['get', 'post'], 'user/{id}/messages', ['as' => 'user.messages', 'uses' => 'UserController@messages']);
		Route::match(['get', 'post'], 'user/{id}/tribes', ['as' => 'user.tribes', 'uses' => 'UserController@tribes']);
		Route::match(['get', 'post'], 'user/{id}/tribe/leave', ['as' => 'user.tribe.leave', 'uses' => 'UserController@tribe_leave']); // leave tribe
		Route::match(['get', 'post'], 'user/{id}/projects', ['as' => 'user.projects', 'uses' => 'UserController@projects']);
		Route::match(['get', 'post'], 'user/{id}/project/leave', ['as' => 'user.project.leave', 'uses' => 'UserController@project_leave']); // leave project
			// user ajax
			Route::get('user/{id}/notification/read', ['as' => 'ajax.user.notification.read', 'uses' => 'UserController@notification_read']);

		// Tribe
		Route::match(['get', 'post'], 'tribe/create', ['as' => 'tribe.create', 'uses' => 'TribeController@create']);
		Route::group(['namespace' => 'Tribe'], function () {
			// Tribe Detail
			Route::match(['get'], 'tribe/{id}', ['as' => 'tribe.detail', 'uses' => 'DetailController@index']);
			Route::match(['get', 'post'], 'tribe/{id}/edit', ['as' => 'tribe.detail.edit', 'uses' => 'DetailController@edit']);
			Route::match(['get'], 'tribe/{id}/join-requests', ['as' => 'tribe.detail.join_requests', 'uses' => 'DetailController@join_requests']);
			Route::match(['get'], 'tribe/{id}/members', ['as' => 'tribe.detail.members', 'uses' => 'DetailController@members']);
			Route::match(['get'], 'tribe/{id}/projects', ['as' => 'tribe.detail.projects', 'uses' => 'DetailController@projects']);
			Route::match(['get'], 'tribe/{id}/invites', ['as' => 'tribe.detail.invites', 'uses' => 'DetailController@invites']);
			Route::match(['post'], 'tribe/{id}/invite', ['as' => 'tribe.detail.invite', 'uses' => 'DetailController@invite']);
			Route::match(['get'], 'tribe/{id}/discussions', ['as' => 'tribe.detail.discussions', 'uses' => 'DetailController@discussions']);
			Route::match(['get'], 'tribe/{id}/messages', ['as' => 'tribe.detail.messages', 'uses' => 'DetailController@messages']);

			// debug
			Route::match(['get'], 'tribe/{id}/old', ['as' => 'tribe.detail.old', 'uses' => 'DetailOldController@index']);
			Route::match(['get', 'post'], 'tribe/{id}/edit/old', ['as' => 'tribe.detail.edit.old', 'uses' => 'DetailOldController@edit']);
			Route::match(['get'], 'tribe/{id}/join-requests/old', ['as' => 'tribe.detail.join_requests.old', 'uses' => 'DetailOldController@join_requests']);
			Route::match(['get'], 'tribe/{id}/members/old', ['as' => 'tribe.detail.members.old', 'uses' => 'DetailOldController@members']);
			Route::match(['get'], 'tribe/{id}/projects/old', ['as' => 'tribe.detail.projects.old', 'uses' => 'DetailOldController@projects']);
			Route::match(['get'], 'tribe/{id}/invites/old', ['as' => 'tribe.detail.invites.old', 'uses' => 'DetailOldController@invites']);
			Route::match(['get'], 'tribe/{id}/discussions/old', ['as' => 'tribe.detail.discussions.old', 'uses' => 'DetailOldController@discussions']);
			Route::match(['get'], 'tribe/{id}/messages/old', ['as' => 'tribe.detail.messages.old', 'uses' => 'DetailOldController@messages']);

			// Join To/Leave Tribe
			Route::match(['post'], 'tribe/{id}/join', ['as' => 'tribe.detail.join', 'uses' => 'DetailController@join']);
			Route::match(['get', 'post'], 'tribe/{id}/leave', ['as' => 'tribe.detail.leave', 'uses' => 'DetailController@leave']);
		});

		// Project
		Route::match(['get', 'post'], 'tribe/{id}/project/create', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
		Route::match(['get'], 'project/{id}', ['as' => 'project.detail', 'uses' => 'ProjectController@detail']);
		Route::group(['namespace' => 'Project'], function () {
			// Project Detail
			Route::match(['get'], 'project/{id}', ['as' => 'project.detail', 'uses' => 'DetailController@index']);
			Route::match(['get', 'post'], 'project/{id}/edit', ['as' => 'project.detail.edit', 'uses' => 'DetailController@edit']);
			Route::match(['get'], 'project/{id}/join-requests', ['as' => 'project.detail.join_requests', 'uses' => 'DetailController@join_requests']);
			Route::match(['get'], 'project/{id}/members', ['as' => 'project.detail.members', 'uses' => 'DetailController@members']);
			Route::match(['get'], 'project/{id}/projects', ['as' => 'project.detail.projects', 'uses' => 'DetailController@projects']);
			Route::match(['get'], 'project/{id}/discussions', ['as' => 'project.detail.discussions', 'uses' => 'DetailController@discussions']);
			Route::match(['get'], 'project/{id}/messages', ['as' => 'project.detail.messages', 'uses' => 'DetailController@messages']);

			// debug
			Route::match(['get'], 'project/{id}/old', ['as' => 'project.detail.old', 'uses' => 'DetailOldController@index']);
			Route::match(['get', 'post'], 'project/{id}/edit/old', ['as' => 'project.detail.edit.old', 'uses' => 'DetailOldController@edit']);
			Route::match(['get'], 'project/{id}/join-requests/old', ['as' => 'project.detail.join_requests.old', 'uses' => 'DetailOldController@join_requests']);
			Route::match(['get'], 'project/{id}/members/old', ['as' => 'project.detail.members.old', 'uses' => 'DetailOldController@members']);
			Route::match(['get'], 'project/{id}/discussions/old', ['as' => 'project.detail.discussions.old', 'uses' => 'DetailOldController@discussions']);
			Route::match(['get'], 'project/{id}/messages/old', ['as' => 'project.detail.messages.old', 'uses' => 'DetailOldController@messages']);

			// Join To Project
			Route::match(['post'], 'project/{id}/join', ['as' => 'project.detail.join', 'uses' => 'DetailController@join']);
		});

		// Discussion
		Route::match(['get'], 'discussion/showcreate/{type?}/{ref_id?}', ['as' => 'discussion.showcreate', 'uses' => 'DiscussionController@showCreate']);
		Route::match(['post'], 'discussion/create', ['as' => 'discussion.create', 'uses' => 'DiscussionController@create']);
		Route::group(['namespace' => 'Discussion'], function () {
			// Discussion Detail
			Route::match(['get'], 'discussion/{id}', ['as' => 'discussion.detail', 'uses' => 'DetailController@index']);
			Route::match(['get', 'post'], 'discussion/{id}/edit', ['as' => 'discussion.detail.edit', 'uses' => 'DetailController@edit']);
		});

		// Message
		Route::match(['get'], 'message/{user_id}/list', ['as' => 'message.list', 'uses' => 'MessageController@index']);
		Route::match(['post'], 'message/{user_id}/send', ['as' => 'message.send', 'uses' => 'MessageController@send']);

		// Messaging
		Route::group(['prefix' => 'messages'], function () {
			Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
			Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
			Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
			Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
			Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
		});
	});

	/*
	|--------------------------------------------------------------------------
	| Files
	|--------------------------------------------------------------------------
	*/
	Route::group(['prefix' => 'file'], function () {
		Route::get('{hash}', ['as' => 'file.get', 'uses' => 'FileController@get']);
		Route::get('thumb/{hash}', ['as' => 'file.thumb.get', 'uses' => 'FileController@get_thumb']);
		Route::get('{hash}/download', ['as' => 'file.download', 'uses' => 'FileController@download']);
		Route::post('upload', ['as' => 'file.upload', 'uses' => 'FileController@upload']);
		Route::match(['delete'], '{hash}/delete', ['as' => 'files.delete', 'uses' => 'FileController@delete']);
	});

	/*
	|--------------------------------------------------------------------------
	| Avatar
	|--------------------------------------------------------------------------
	*/
	Route::group(['prefix' => 'avatar'], function () {
		Route::get('{hash}', ['as' => 'avatar.get', 'uses' => 'FileController@get']);
		Route::get('{hash}/download', ['as' => 'avatar.download', 'uses' => 'FileController@download']);
	});

	Route::match(['get', 'post'], 'tribes', ['as' => 'tribe.list', 'uses' => 'TribeController@index']);
	Route::match(['get', 'post'], 'projects', ['as' => 'project.list', 'uses' => 'ProjectController@index']);
	Route::match(['get', 'post'], 'discussions', ['as' => 'discussion.list', 'uses' => 'DiscussionController@index']);

	Route::match(['get'], 'user/{id}', ['as' => 'user.detail', 'uses' => 'UserController@detail']);

	// Stripe Webhook
	Route::post(
	    'stripe/webhook',
	    'Payment\StripeWebhookController@handleWebhook'
	);
});
