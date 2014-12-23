<?php

class UsersController extends BaseController {

	protected $layout = "layouts.main";

	public function register() 
	{
		return View::make('users.register');
	}

	public function login()
	{
		return View::make('users.login');
	}

	public function postLogin()
	{
		$credentials = Input::only(['email', 'password']);

		try
		{
			$user = Sentry::authenticate($credentials, false);
			if($user){
	        	Sentry::loginAndRemember($user);
	            return Redirect::to('/');
	        }

        	return Redirect::route('login')->withInput();
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
		    echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
		    echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
		    echo 'Wrong password, try again.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
		    echo 'User is not activated.';
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
		    echo 'User is suspended.';
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
		    echo 'User is banned.';
		}
        
	}

	public function logout()
	{
		Sentry::logout();

		return Redirect::route('login');
	}














	/*=====================================================
	 *=====================================================
	 */

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// 
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		//
		try
		{
			// Create the user
			$user = Sentry::createUser(array(
				'email'     => Input::get('email'),
				'password'  => Input::get('password'),
				'first_name'=> Input::get('fisrt_name'),
				'last_name' => Input::get('last_name'),
				'activated' => true,
			));

			// Find the group using the group id
			$defaultGroup = Sentry::findGroupById(3);

			if($user) 
			{
				// Assign the group to the user
				$user->addGroup($defaultGroup);

				// Login and Remember the user
				Sentry::loginAndRemember($user);
				return Redirect::route('register');
			}

			return Redirect::route('user.register')->withInput();
			
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			echo 'Login field is required.';
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			echo 'Password field is required.';
		}
		catch (Cartalyst\Sentry\Users\UserExistsException $e)
		{
			echo 'User with this login already exists.';
		}
		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
			echo 'Group was not found.';
		}
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}