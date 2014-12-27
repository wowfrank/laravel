<?php

class Balance extends \Model {
	public $timestamps = true;
	
	protected $table = 'balance';

	protected $fillable = ['transfered', 'tran_screenshot', 'tran_date', 'received', 'rece_screenshot', 'rece_date', 'path'];

	public static $rules = [];

    //Use this for custom messages
    public static $messages = [
        'transfered.required' => 'My custom message for :attribute required',
    ];
}