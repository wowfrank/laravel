<?php

class QrcodesController extends \BaseController {

	/**
	 * Check The input QrCode String is valid
	 * POST /qrcodes/check/
	 *
	 * @return Response
	 */
	public function checkQrcode()
	{
		if(Session::token() !== Input::get('_token')) {
			return Response::json(['msg' => 'unAuthorized Access is denied!']);
		}

		// Decrypt string with the secret key
		$encryptStr = Input::get('encrypted_str');
		$encryptStr = base64_decode(urldecode($encryptStr));

		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decryptStr = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, Config::get('app.key'), $encryptStr, MCRYPT_MODE_ECB, $iv);


		$pattern = '/(\d{2})-(\d{2})-(\d{4}) (\d{2}):(\d{2}):(\d{2})([ap])(m) ([A-Z]{3})(\d{6})/';
		if( !preg_match($pattern, $decryptStr) ) $decryptStr = 'Wrong QrCode!';
		
		return Response::json(['msg' => $decryptStr]);

		// return Redirect::route('qrcodes.index')->withInput();
	}

	/**
	 * Display a listing of the resource.
	 * GET /qrcodes
	 *
	 * @return Response
	 */
	public function index()
	{
		// Encrypt String with a secret key
		for($i = 0; $i < 10; $i++) {
			$qrStr = date('d-m-Y h:i:sa') . ' ' . Order::generateRandomStr();
			$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		    $encryptStr = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, Config::get('app.key'), utf8_encode($qrStr), MCRYPT_MODE_ECB, $iv);
		    $encryptStr = trim(base64_encode($encryptStr));
		    $result[] = $encryptStr;
		}
		return View::make('qrcodes.index', 
						['qrStrs'=>$result]
					);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /qrcodes/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /qrcodes
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /qrcodes/{id}
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
	 * GET /qrcodes/{id}/edit
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
	 * PUT /qrcodes/{id}
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
	 * DELETE /qrcodes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}