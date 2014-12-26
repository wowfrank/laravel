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
Route::group(['before' => 'auth|admin'], function()
{
	Route::resource('users', 'UsersController', ['only' => ['login', 'register']]);
	Route::resource('order', 'OrderController');
	Route::resource('product', 'ProductController');
});

# Route Upload Images for Orders
Route::post('order/uploadImage', function() {
	
	// getting all of the post data
	$files = Input::file('images');
	$orderNo = Input::Input('order_no');
	$orderId = Input::Input('order_id');
	$result  = ['success' => false, 'message' => ''];
	// path is root/uploads
	$destinationPath = 'packages/uploads/images/';
	$destinationTPath = 'packages/uploads/thumbnails/';


	foreach($files as $file) {
		// validating each file.
		$rules = ['image' => 'required|image|mimes:jpeg,jpg,bmp,png,gif']; //'required|mimes:png,gif,jpeg,txt,pdf,doc'
		$validator = Validator::make( ['image'=> $file], $rules);

		if($validator->passes()){
						$filename = $orderNo . '-' . $file->getClientOriginalName();
			if ( $file->move($destinationPath, $filename) )
			{
				$newImage = Images::firstOrCreate(['order_id' => $orderId, 'filename'=> $filename, 'path' => $destinationPath]);

				// resize the image to a height of 200 and constrain aspect ratio (auto width)
				Image::make($destinationPath . $filename)
								->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })
								->save($destinationTPath . 'thumb-' . $orderNo . '-' . $file->getClientOriginalName());
				// flash message to show success.
				// Session::flash('success', 'Upload successfully'); 
				$result['success'] = true; 
			} else $result['message'] = 'FAILED TO MOVE TO SERVER FOLDER! ';
		} else $result['message'] = 'UNKNOW FILE TYPE or YOU DIDNT SELECT AN IMAGE! ';
	}
	return Response::json($result);
});
