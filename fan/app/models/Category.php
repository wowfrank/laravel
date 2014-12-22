<?php

class Category extends \Model {
	
	protected $table = 'category';

	protected $fillable = ['category'];

	protected static $rules = [
        'category' => 'required',
    ];

    //Use this for custom messages
    protected static $messages = [
        'category.required' => 'My custom message for :attribute required',
    ];
}