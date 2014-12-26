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

Route::resource('order', 'OrderController');

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

Route::post('order/create', [
	'as' => 'order.create',
	'uses' => 'OrderController@create']);

# Standard User Routes
Route::group(['before' => 'auth'], function()
{
	Route::resource('users', 'UsersController', ['only' => ['login', 'register']]);
	Route::resource('order', 'OrderController');
	Route::resource('product', 'ProductController');
});

# Route Upload Images for Orders
Route::post('order/uploadImage', function() {
	
	
	return Response::json(['success' => false]);
});
