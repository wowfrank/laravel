<?php

class Product extends \Model {
	protected $fillable = ['cname', 'ename', 'brand', 'unit',
                                    'suggest_price', 'retail_lowest', 'gross_weight',
                                    'note', 'item_no', 'status', 'description', 'category_id'];

	protected $table = 'product';

	public static $rules = [
        'cname' => 'required',
        'ename' => 'required',
        'brand' => 'required',
        'unit' => 'required',
        'suggest_price' => 'required',
        'retail_lowest' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'cname.required' => 'My custom message for :attribute required',
        'ename.required' => 'My custom message for :attribute required', 
        'brand.required' => 'My custom message for :attribute required', 
        'unit.required' => 'My custom message for :attribute required', 
        'suggest_price.required' => 'My custom message for :attribute required', 
        'retail_lowest.required' => 'My custom message for :attribute required', 
    ];

    // DEFINE RELATIONSHIPS -----------------------
    // each product HAS one category
    public function category() {
        return $this->belongsTo('Category', 'category_id'); 
    }

    // each product BELONGS to many orders
    // define our pivot table also, define a many to many relationship
    public function order() {
        return $this->belongsToMany('Order', 'order_product', 'order_id', 'product_id');
    }
}