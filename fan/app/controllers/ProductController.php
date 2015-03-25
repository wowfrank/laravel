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
		// dd($productInfo); die;
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

	/**
	 * Export Product to Excel and Download it
	 * GET /product/download
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function downloadExp($id)
	{
		// Retrieve products from DB
		$products 	= Product::orderBy('cname', 'ASC')
    							->orderBy('brand', 'ASC')
    							->orderBy('ename', 'ASC')
    							->orderBy('unit', 'ASC')
    							->orderBy('note', 'DESC')
    							->get();

		// export & download products
    	Excel::create(date('Y-m-d'), function($excel) use($products) {

    		$excel->sheet(date('Y-m-d'), function($sheet) use ($products) {
    			// Insert Header
    			$pHeader	= [trans('productExp.name'), trans('productExp.category'), trans('productExp.barcode'), trans('productExp.inventory'), trans('productExp.price-in'), 
    							trans('productExp.price-out'), trans('productExp.wholesale'), trans('productExp.price-mem'), trans('productExp.points'), 
    							trans('productExp.discount'), trans('productExp.invent-up'), trans('productExp.invent-dw'), trans('productExp.supplier'), 
    							trans('productExp.pro-date'), trans('productExp.g-period'), trans('productExp.pinyin'), trans('productExp.extra'), 
    							trans('productExp.brand'), trans('productExp.english'), trans('productExp.unit'), trans('productExp.status'), 
    							trans('productExp.description')];
    			$sheet->appendRow($pHeader);

    			// Insert products
    			foreach($products as $product) {
    				$pData = [];
    				$pData = array_add($pData, 'name', $product->cname.'='.$product->brand.'='.$product->ename);
    				$pData = array_add($pData, 'category', $product->category->category);
    				$pData = array_add($pData, 'barcode', '');
    				$pData = array_add($pData, 'inventory', '0');
    				$pData = array_add($pData, 'price-in', $product->suggest_price);
    				$pData = array_add($pData, 'price-out', $product->suggest_price);
    				$pData = array_add($pData, 'wholesale', $product->suggest_price);
    				$pData = array_add($pData, 'price-mem', $product->suggest_price);
    				$pData = array_add($pData, 'points', trans('productExp.no'));
    				$pData = array_add($pData, 'discount', trans('productExp.no'));
    				$pData = array_add($pData, 'invent-up', '10000');
    				$pData = array_add($pData, 'invent-dw', '0');
    				$pData = array_add($pData, 'supplier', trans('productExp.none'));
    				$pData = array_add($pData, 'pro-date', date('Y-m-d'));
    				$pData = array_add($pData, 'g-period', '2');
    				$pData = array_add($pData, 'pinyin', '');
    				$pData = array_add($pData, 'extra', '');
    				$pData = array_add($pData, 'brand', $product->brand);
    				$pData = array_add($pData, 'english', $product->ename);
    				$pData = array_add($pData, 'unit', $product->unit);
    				$pData = array_add($pData, 'status', trans('productExp.active'));
    				$pData = array_add($pData, 'description', $product->description);
    				$sheet->appendRow($pData);
    			}
			    
			});
    	})->export('xls');

		return Redirect::to( URL::previous() );
	}

	public function batchprocess()
	{
		// getting all of the post data
		$file = ['uploadFile' => Input::file('batch-process')];
		// setting up rules
		$rules = ['uploadFile' => 'required',]; 
		// doing the validation, passing post data, rules and the messages
		$validator = Validator::make($file, $rules);
		if ($validator->fails()) {
			// send back to the page with the input data and errors
			return Redirect::route('product.create')->withInput()->withErrors($validator);
		} else {
			// checking file is valid.
			if (Input::file('batch-process')->isValid()) {
				// batch processing
				Excel::load(Input::file('batch-process'), function($reader) {
				    // reader methods
				    // $reader->dd();
																																																																																																																																																																																											    	// loop through all rows
			    	$reader->each(function($row) {
			    		$proCate = Category::where('category', '=', trim($row->category))->first();
			    		if(!is_null($proCate)){
			    			$product = Product::where('cname', '=', trim($row->name))
			    							->where('ename', '=', trim($row->english))
			    							->where('brand', '=', trim($row->brand))
			    							->where('unit', '=', trim($row->unit))->first();
			    			if(is_null($product)) {
			    				$product = new Product;
			    				$product->cname = $row->name;
			    				$product->ename = $row->english;
			    				$product->brand = $row->brand;
			    				$product->unit = $row->unit;
			    				$product->suggest_price = 0;
			    				$product->retail_lowest = 0;
			    				$product->gross_weight = 0;
			    				$product->note = '';
			    			}
			    			$product->category_id = $proCate->id;
				    		if ($row->description != '') $product->description = $row->description;
				    		$product->status = 1;
				    		$product->save();
			    		}
			    	});
				}, 'UTF-8');
				
				// sending back with message
				Session::flash('success', trans('message.Upload & Process Successfully')); 
				return Redirect::route('product.create');
			} else {
				// sending back with error message.
				Session::flash('error', 'uploaded file is not valid');
				return Redirect::route('product.create');
			}
		}
	}

}
