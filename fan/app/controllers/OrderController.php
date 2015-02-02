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
		$order = Order::orderBy('id', 'DESC')->get();
		
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
	    							->orderBy('ename', 'ASC')
	    							->orderBy('unit', 'ASC')
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
		$products 	= $order->product()
								->orderBy('cname', 'ASC')
    							->orderBy('brand', 'ASC')
    							->orderBy('ename', 'ASC')
    							->orderBy('unit', 'ASC')
    							->orderBy('note', 'DESC')
    							->get();
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
		$products 	= $order->product()
								->orderBy('cname', 'ASC')
    							->orderBy('brand', 'ASC')
    							->orderBy('ename', 'ASC')
    							->orderBy('unit', 'ASC')
    							->orderBy('note', 'DESC')
    							->get();

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
		$extras		= Input::only('extra');
		$feedbacks 	= Input::only('feedback');

		for($i = 0; $i < count($productIDs['product_id']); $i++)
		{
			$orderIDs['order_id'][$i] = $order->id;
		}

		if ( count($productIDs['product_id']) == 0 ) 
		{
			$orderIDs['order_id'][0] = $id;
			$productIDs['product_id'] = [];
			$quantities['quantity'] = [];
			$extras['extra'] = [];
			$feedbacks['feedback'] = [];
			
		}

		// @TODO error handler!
		if($order->save())
		{
			$pivotInfo = array_map(function($x, $y, $z, $w, $v) { return array('order_id'=> $z, 'product_id'=> $x, 'quantity' => $y, 'feedback'=>$w, 'extra' => $v); }, 
									$productIDs['product_id'], $quantities['quantity'], $orderIDs['order_id'], $feedbacks['feedback'], $extras['extra']);

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


	/**
	 * Save products to an order
	 * Post /order/saveToOrder/{id}
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function saveToOrder($id)
	{
		$order 		= Order::find($id);
		$data 			= json_decode(stripslashes(Input::get('dataString')), true);
		$product_array 	= array_column($data, 'value');

		for($i = 0; $i < count($product_array); $i++)
		{
			if ( !$order->product->contains($product_array[$i]) )
			{

				$orderIDs['order_id'][$i] = $id;
				$productIDs['product_id'][$i] = $product_array[$i];
				$quantities['quantity'][$i] = 1;
			}
		}

		// @TODO error handler!
		if($order && !empty($productIDs))
		{
			$pivotInfo = array_map(function($x, $y, $z) { return array('order_id'=> $z, 'product_id'=> $x, 'quantity' => $y); }, 
									$productIDs['product_id'], $quantities['quantity'], $orderIDs['order_id']);


			$order->product()->sync($pivotInfo, false);
		} else {

		}

		return Redirect::route('order.edit', [$id]);
	}
	/**
	 * Water Mark Image
	 * GET /order/watermark/{id}
	 *
	 * @param int $id
	 * @return Response
	 *
	 */
	public function watermark($id)
	{
		// if watermark.png is not existed, we create iterator_apply(iterator, function)	
		if ( !file_exists('packages/uploads/thumbnails/watermark.png') )
		{
			$wm = Image::canvas(120, 25);
			$wm->text('RECEIVED!', 60, 10, function($font) {
				$font->color(array(255, 0, 0, 0.7));
				$font->align('center');
				$font->valign('center');
			});
			$wm->save('packages/uploads/thumbnails/watermark.png');
		}

		$images = Images::find($id);
		$img = Image::make('packages/uploads/thumbnails/thumb-'. $images->filename);
		$img->insert('packages/uploads/thumbnails/watermark.png', 'center');
		$img->save();

		$images->watermark = true;
		$images->save();

		return Redirect::to( URL::previous() );
	}

	/**
	 * Export Order to Excel and Download it
	 * GET /order/download/{id}
	 * 
	 * @param int $id
	 * @return Response
	 */
	public function download($id)
	{
		$order 		= Order::find($id);
		
		// export & download order
    	Excel::create($order->order_no, function($excel) use($order) {
    		$excel->sheet($order->order_no, function($sheet) use ($order) {
    			$category 	= Category::all();
				$products 	= $order->product()
										->orderBy('cname', 'ASC')
		    							->orderBy('brand', 'ASC')
		    							->orderBy('ename', 'ASC')
		    							->orderBy('unit', 'ASC')
		    							->orderBy('note', 'DESC')
		    							->get();

    			// first row styling and writing content
    			$sheet->mergeCells('A1:L3');
    			$sheet->row(1, function ($row) {
		            $row->setFontFamily('Comic Sans MS');
		            $row->setFontSize(30);
		            $row->setFontWeight('bold');
        		});
        		$sheet->row(1, array('Order#'.$order->order_no.' Product List'));

        		foreach($category as $c) {
        			if ( Product::isCategoryInList($c->id, $products) ) {
        				// Append an empty row and a category row
				        $sheet->appendRow(['']);
				        $sheet->appendRow([$c->category])
				        		->mergeCells('A'.$sheet->getHighestRow(). ':L' .$sheet->getHighestRow())
				        		->row($sheet->getHighestRow(), function ($row) {
								            $row->setFontColor('#83D6CE');
								            $row->setFontSize(12);
		            						$row->setFontWeight('bold');
								        });

				        // Append a header row
        				$pHeader = ['Chinese Name', 'English Name', 'Brand', 'Unit', 'Description', 'Suggest Price', 'Retail Lowest', 'Gross Weight', 'Note', 'Quantity', 'Extra Info'];
        				$sheet->appendRow($pHeader)
        						->row($sheet->getHighestRow(), function ($row) {
        									$row->setFontSize(10);
        									$row->setFontColor('#61696B');
		            						$row->setFontWeight('italic');
								        });

        				// Append products rows
        				foreach($products as $product) {
        					if ($product->category_id == $c->id) {
        						$pData = array_except($product->toArray(), ['id', 'category_id', 'pivot', 'created_at', 'updated_at', 'status']);
        						$pData = array_add($pData, 'quantity', $product->pivot->quantity);
        						$pData = array_add($pData, 'extra', $product->pivot->extra);
        						$sheet->appendRow($pData)
        								->row($sheet->getHighestRow(), function ($row) {
								            $row->setFontColor('#727877');
								            $row->setFontSize(10);
								        });
        					}
        				}
        			}
        		}
		        
			});
    	})->export('xlsx');

		return Redirect::to( URL::previous() );
	}
}
