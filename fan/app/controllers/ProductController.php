<?php

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /product
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		$category 	= Category::all();
		$product 	= Product::orderBy('cname', 'ASC')
    							->orderBy('brand', 'ASC')
    							->orderBy('ename', 'ASC')
    							->orderBy('unit', 'ASC')
    							->orderBy('note', 'DESC')
    							->get();

		return View::make('product.index', 
						array('productList' => $product, 'categoryList'=>$category));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /product/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		$category = Category::lists('category', 'id');

		return View::make('product.create', array('categoryList' => $category));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /product
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		$productInfo 	= Input::all();
		$product 	= Product::create($productInfo);
		
		if($product){
            
		return Redirect::route('product.index');
        }

        return Redirect::route('product.create')->withInput();
	}

	/**
	 * Display the specified resource.
	 * GET /product/{id}
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
	 * GET /product/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$product 	= Product::find($id);
		$category = Category::lists('category', 'id');

		return View::make('product.edit', 
					['product' => $product, 'categoryList'=>$category]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /product/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$updateInfo	= Input::all();
		$validation = Validator::make($updateInfo, Product::$rules);

		if ($validation->passes())
        {
            $product 	= Product::find($id);
            $product->update($updateInfo);
            return Redirect::route('product.index');
        }
		return Redirect::route('product.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /product/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		echo Product::find($id)->delete() ?  true : false;
	}


	/**
	 * Add Products to Order
	 * GET /product/addto/{orderid}
	 * 
	 * @param int $orderId
	 * @return Response
	 *
	 */
	public function addToOrder($orderId)
	{
		$category 	= Category::all();
		$product 	= Product::orderBy('cname', 'ASC')
    							->orderBy('brand', 'ASC')
    							->orderBy('ename', 'ASC')
    							->orderBy('unit', 'ASC')
    							->orderBy('note', 'DESC')
    							->get();

		return View::make('order.add2order', 
						['productList' => $product, 'categoryList'=>$category, 'orderId' => $orderId]);
	}

}
