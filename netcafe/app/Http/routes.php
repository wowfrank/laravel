<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 
	['as' => '/', 'uses' => 'HomeController@index']);

// Blog pages
// Route::get('/', function () {
// 	return redirect('/blog');
// });

Route::get('blog', 
	['as' => 'blog.index', 'uses' => 'BlogController@index']);
Route::get('blog/{slug}', 
	['as' => 'blog.show', 'uses' => 'BlogController@show'])
	->where('slug', '[A-Za-z0-9-_]+');

// Send Contact Form
Route::post('contact', 
	['as' => 'contact', 'uses' => 'ContactController@sendContactInfo']);

// Admin area
Route::get('admin', function () {
	return redirect('/admin/post');
});
Route::group([
	'namespace' => 'Admin',
	'middleware' => 'auth',
		], function () {
			Route::resource('admin/post', 'PostController');
			Route::post('admin/post/store', 'PostController@store');
			
			Route::resource('admin/tag', 'TagController', ['except' => 'show']);
			Route::resource('admin/activity', 'ActivityController', ['except' => 'show']);
			Route::resource('admin/team', 'TeamController', ['except' => 'show']);
			Route::resource('admin/cover', 'CoverController', ['except' => 'show']);

			Route::get('admin/upload', 'UploadController@index');
			Route::post('admin/upload/file', 'UploadController@uploadFile');
			Route::delete('admin/upload/file', 'UploadController@deleteFile');
			Route::post('admin/upload/folder', 'UploadController@createFolder');
			Route::delete('admin/upload/folder', 'UploadController@deleteFolder');

			// delete comment
	 		// Route::post('comment/delete/{id}','CommentController@distroy');
	 		// delete post
	 		// Route::get('post/delete/{id}','PostController@destroy');
	 		// update post
	 		// Route::post('post/update','PostController@update');
	 		// edit post form
	 		// Route::get('post/edit/{slug}','PostController@edit');
	 		// show new post form
	 		// Route::get('new-post','PostController@create');
	 		// save new post
	 		// Route::post('new-post','PostController@store');
		}
);

// Logging in and out
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::get('/user/logout', 
			['as' => 'user.logout',
			'uses' => 'Auth\AuthController@getUserLogout']);

// Message create and list
Route::get('message',  
			['as' => 'message.list', 
			'uses' => 'MessageController@listMessages']);
Route::post('message/store',
			['as' => 'message.store',
			'uses' => 'MessageController@storeMessage']);

// We don't want to add additional routes for every provider we add so we need some kind of URL pattern 
// which allows use to use as few routes as possible.
// One route will handle redirect back request from social sites after their authentication process is done
Route::get('message/social/login/redirect/{provider}', 
			['uses' => 'Auth\AuthController@redirectToProvider', 
			'as' => 'social.login']);
// One route will send our login request to the social site
Route::get('message/social/login/{provider}', 'Auth\AuthController@handleProviderCallback');
