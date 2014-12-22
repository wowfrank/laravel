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

Route::get('register', array('as' => 'register', 'uses' => 'UsersController@register'));

Route::get('login', array('as' => 'login', 'uses' => 'UsersController@login'));
Route::post('/login', array('as' => 'login', 'uses' => 'UsersController@postLogin'));

Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@logout'));

Route::get('product/update/{id}', function($id)
{
    return 'User '.$id;
});