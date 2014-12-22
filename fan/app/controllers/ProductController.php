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
		$productInfo 	= Input::only(['cname', 'ename', 'brand', 'unit',
									'suggest_price', 'retail_lowest', 'gross_weight',
									'note', 'item_no', 'status']);
		$product 		= Product::create($productInfo);

		if($product){
            return Redirect::route('product.show');
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
		$category 	= Category::all();
		$product 	= Product::all();

		return View::make('product.show', 
						['productList' => $product, 'categoryList'=>$category]);
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
		$product = Product::find($id);

		return View::make('product.update', ['product' => $product])
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
	}

}