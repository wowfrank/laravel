<?php

namespace Netcafe\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    protected $fillable = [
		'msg_content', 'msg_ip', 'cafe_service', 'cafe_hardware', 'cafe_hygiene', 
		'cafe_environment', 'cafe_price', 'msg_agreement',
	];
}
