<?php

class Order extends \Model {
    public $timestamps = true;
    
	protected $fillable = ['order_no', 'status', 'sum', 'labor', 'transport', 'qrcode'];

	protected $table = 'order';

	public static $rules = [
        'status' => 'required',
        'order_no' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'order_no.required' => 'My custom message for :attribute required',
    ];

    // DEFINE RELATIONSHIPS -----------------------
   
    // each order HAS many products, $this->belongsToMany('Product', 'order_product', 'product_id', 'order_id')
    // define our pivot table also, define a many to many relationship
    public function product()
    {
        return $this->belongsToMany('Product')
                    ->withPivot('quantity', 'feedback', 'extra')
                    ->withTimestamps();
    }

    public function image()
    {
        return $this->hasMany('Images', 'id'); 
    }

    public static function generateRandomStr()
    {
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        shuffle($seed); // probably optional since array_is randomized; this may be redundant

        $rand = '';
        foreach (array_rand($seed, 3) as $k) $rand .= $seed[$k];

        return $rand . mt_rand(100000, 999999);
    }
}