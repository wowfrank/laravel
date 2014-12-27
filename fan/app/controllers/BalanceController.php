<?php

class BalanceController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /balance
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$balance = Balance::orderBy('id', 'DESC')->get();

		return View::make('balance.index', ['balanceList' => $balance]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /balance/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /balance
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$destinationPath = 'packages/uploads/screenshots/';
		$randomNum = mt_rand(10000, 99999);
		$balanceInfo = Input::only('tran_date', 'transfered', 'tran_screentshot', 'rece_date', 'received', 'rece_screenshot');
		$tranImage = Input::file('tran_screenshot');
		$tranImageName = 'tran_' . $randomNum . '-' . $tranImage->getClientOriginalName();
		$receImage = Input::file('rece_screenshot');
		$receImageName = 'rece_' . $randomNum . '-' . $receImage->getClientOriginalName();
		$rules = ['tran_screenshot' => 'required|image|mimes:jpeg,jpg,bmp,png,gif',
				'rece_screenshot' => 'required|image|mimes:jpeg,jpg,bmp,png,gif',
				'transfered' => 'required|numeric|min:0', 
				'received' => 'required|numeric|min:0'];
		$validator = Validator::make( ['tran_screenshot'=> $tranImage, 'rece_screenshot' => $receImage, 'transfered' => $balanceInfo['transfered'], 'received' => $balanceInfo['received'] ], $rules);

		if ( $validator->passes() ) {
			if ($tranImage->move($destinationPath, $tranImageName) && $receImage->move($destinationPath, $receImageName)) {
				Image::make($destinationPath . $tranImageName)
								->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })
								->save('packages/uploads/thumbnails/' . 'thumb-' . $tranImageName);
				Image::make($destinationPath . $receImageName)
								->resize(150, null, function ($constraint) { $constraint->aspectRatio(); })
								->save('packages/uploads/thumbnails/' . 'thumb-' . $receImageName);
				$balanceInfo['tran_screenshot'] = $tranImageName;
				$balanceInfo['rece_screenshot'] = $receImageName;
				$balanceInfo['path'] = $destinationPath;
				$balance = Balance::create($balanceInfo);
				if ($balance) return Redirect::route('balance.index');
				else return Redirect::route('balance.index')->withInput();
			}
		} else return Redirect::route('balance.index')->withInput();
	}

	/**
	 * Display the specified resource.
	 * GET /balance/{id}
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
	 * GET /balance/{id}/edit
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
	 * PUT /balance/{id}
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
	 * DELETE /balance/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		echo Balance::find($id)->delete() ?  true : false;
	}

}