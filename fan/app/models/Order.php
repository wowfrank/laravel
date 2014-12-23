<?php

class Order extends \Model {
	protected $fillable = ['order_no', 'status'];

	protected $table = 'order';

	public static $rules = [
        'order_no' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'order_no.required' => 'My custom message for :attribute required',
    ];

    // DEFINE RELATIONSHIPS -----------------------
   
    // each order HAS many products
    // define our pivot table also, define a many to many relationship
    public function product() {
        return $this->belongsToMany('Product', 'order_product', 'product_id', 'order_id');
    }
}