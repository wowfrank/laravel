<?php

class Images extends \Model {
    public $timestamps = true;

	protected $fillable = ['filename', 'path', 'order_id'];

	protected $table = 'image';

	public static $rules = [
        'filename' => 'required',
        'path' => 'required',
        'order_id' => 'required',
    ];

    //Use this for custom messages
    public static $messages = [
        'filename.required' => 'My custom message for :attribute required',
        'path.required' => 'My custom message for :attribute required', 
        'order_id.required' => 'My custom message for :attribute required', 
    ];

    // DEFINE RELATIONSHIPS -----------------------
    // each image BELONGS TO many order
    public function order() {
        return $this->belongsTo('Order', 'order_id'); 
    }
}