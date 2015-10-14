<?php

namespace Netcafe\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $fillable = [
		'name', 'nickname', 'imgname', 'phone', 'gender', 'dob', 'duty',
		'weibo', 'qq', 'wechat', 'education', 'status',
	];
}
