<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

# CSRF Protection
# Route::when('*', 'csrf', ['POST', 'PUT', 'PATCH', 'DELETE']);

Route::resource('users', 'UsersController');

Route::resource('product', 'ProductController');

/*

Route::group(array('before' => 'guest'), function () 
{
    Route::get('login', array(
        'as' => 'login', 
        'uses' => 'UsersController@login'
    ));

    Route::post('login', array(
        'before' => 'csrf',
        'uses' => 'UsersController@postLogin'
    ));
});
*/

Route::get('register', [
	'as' => 'register', 
	'uses' => 'UsersController@register']);

Route::get('login', [
	'as' => 'login', 
	'uses' => 'UsersController@login'])->before('guest');

Route::post('login', [
	'as' => 'login', 
	'uses' => 'UsersController@postLogin']);

Route::get('logout', [
	'as' => 'logout', 
	'uses' => 'UsersController@logout']);

Route::get('product/{id}/edit', [
	'uses' => 'ProductController@edit',
	'as' => 'product.edit']);

Route::put('product/{id}', [
	'uses' => 'ProductController@update',
	'as' => 'product.update']);

Route::get('product/{id}/delete', [
	'uses' => 'ProductController@delete',
	'as' => 'product.delete']);

Route::delete('product/{id}', [
	'uses' => 'ProductController@destroy',
	'as' => 'product.destroy']);


//Example use

# Registration
Route::group(['before' => 'guest'], function()
{
	Route::get('register', 'UsersController@create');
	Route::post('register', ['as' => 'users.store', 'uses' => 'UsersController@store']);
});

# Authentication
# Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create'])->before('guest');
# Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
# Route::resource('sessions', 'SessionsController' , ['only' => ['create','store','destroy']]);

# Forgotten Password
# Route::group(['before' => 'guest'], function()
# {
#	 Route::get('forgot_password', 'RemindersController@getRemind');
# 	 Route::post('forgot_password','RemindersController@postRemind');
#	 Route::get('reset_password/{token}', 'RemindersController@getReset');
#	 Route::post('reset_password/{token}', 'RemindersController@postReset');
# });

# Standard User Routes
# Route::group(['before' => 'auth|standardUser'], function()
# {
# 	Route::get('userProtected', 'StandardUserController@getUserProtected');
# 	Route::resource('profiles', 'UsersController', ['only' => ['show', 'edit', 'update']]);
# });

# Admin Routes
# Route::group(['before' => 'auth|admin'], function()
# {
#  	Route::get('/product', ['as' => 'admin_dashboard', 'uses' => 'AdminController@getHome']);
#   Route::resource('admin/profiles', 'AdminUsersController', ['only' => ['index', 'show', 'edit', 'update', 'destroy']]);
# });