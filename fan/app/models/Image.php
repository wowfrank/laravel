<?php

class Image extends \Model {
	protected $fillable = ['filename', 'path'];

	protected $table = 'image';

	public static $rules = [
        'filename' => 'required',
        'path' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'filename.required' => 'My custom message for :attribute required',
        'path.required' => 'My custom message for :attribute required', 
    ];

    // DEFINE RELATIONSHIPS -----------------------
    // each image BELONGS TO many order
    public function order() {
        return $this->belongsTo('Order', 'order_id'); 
    }
}