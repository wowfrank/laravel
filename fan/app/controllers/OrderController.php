<?php

class OrderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /order
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$order = Order::all();

		return View::make('order.index',
			['orderList' => $order]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /order/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		// var_dump(Input::get('dataString')); die;
		$data 			= json_decode(stripslashes(Input::get('dataString')), true);
		$product_array 	= array_column($data, 'value');
		$category 		= Category::all();
		$product 		= Product::whereIn( 'id', $product_array )
									->orderBy('cname', 'ASC')
	    							->orderBy('brand', 'ASC')
	    							->orderBy('unit', 'ASC')
	    							->orderBy('ename', 'ASC')
	    							->orderBy('note', 'DESC')
	    							->get();

		// print_r($product_array); die;
		return View::make('order.create', 
					['categoryList' => $category, 'productList' => $product]);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /order
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$orderInfo 	= Input::all();
		$order 		= Order::create($orderInfo);
		$productIDs	= Input::only('product_id');
		$quantities	= Input::only('quantity');
		for($i = 0; $i < count($productIDs['product_id']); $i++)
		{
			$orderIDs['order_id'][$i] = $order->id;
		}


		// @TODO error handler!
		if($order)
		{
			$pivotInfo = array_map(function($x, $y, $z) { return array('order_id'=> $z, 'product_id'=> $x, 'quantity' => $y); }, 
									$productIDs['product_id'], $quantities['quantity'], $orderIDs['order_id']);

			$order->product()->sync($pivotInfo);
		} else {

		}

		return Redirect::route('order.index');

	}

	/**
	 * Display the specified resource.
	 * GET /order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$order 		= Order::find($id);
		$category 	= Category::all();
		$products 	= $order->product;
		$images 	= Images::where('order_id', '=', $id)->get();

		return View::make('order.show', ['productList' => $products, 'categoryList' => $category, 
								'status' => $order->status, 'images' => $images]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /order/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$order 		= Order::find($id);
		$category 	= Category::all();
		$products 	= $order->product;

		return View::make('order.edit', ['productList' => $products, 'categoryList' => $category, 'order' => $order]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//

		$orderInfo 	= Input::all();
		$order 		= Order::find($id);
		$order->status = Input::get('status');
		$productIDs	= Input::only('product_id');
		$quantities	= Input::only('quantity');
		$feedbacks 	= Input::only('feedback');

		for($i = 0; $i < count($productIDs['product_id']); $i++)
		{
			$orderIDs['order_id'][$i] = $order->id;
		}


		// @TODO error handler!
		if($order->save())
		{
			$pivotInfo = array_map(function($x, $y, $z, $w) { return array('order_id'=> $z, 'product_id'=> $x, 'quantity' => $y, 'feedback'=>$w); }, 
									$productIDs['product_id'], $quantities['quantity'], $orderIDs['order_id'], $feedbacks['feedback']);

			$order->product()->detach();
			$order->product()->sync($pivotInfo);
		} else {

		}

		return Redirect::route('order.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}