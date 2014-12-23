<?php

class Category extends \Model {
	
	protected $table = 'category';

	protected $fillable = ['category'];

	public static $rules = [
        'category' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'category.required' => 'My custom message for :attribute required',
    ];

    // DEFINE RELATIONSHIPS -----------------------
    // each category HAS many products
    public function product() {
        return $this->hasMany('Product', 'id'); 
    }
}