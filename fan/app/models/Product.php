<?php

class Product extends \Model {
	protected $fillable = ['cname', 'ename', 'brand', 'unit',
                                    'suggest_price', 'retail_lowest', 'gross_weight',
                                    'note', 'item_no', 'status'];

	protected $table = 'product';

	protected static $rules = [
        'cname' => 'required',
        'ename' => 'required',
        'brand' => 'required',
        'unit' => 'required',
        'suggest_price' => 'required',
        'retail_lowest' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'cname.required' => 'My custom message for :attribute required',
        'ename.required' => 'My custom message for :attribute required', 
        'brand.required' => 'My custom message for :attribute required', 
        'unit.required' => 'My custom message for :attribute required', 
        'suggest_price.required' => 'My custom message for :attribute required', 
        'retail_lowest.required' => 'My custom message for :attribute required', 
    ];
}