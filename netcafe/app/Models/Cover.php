<?php

namespace Netcafe\Models;

use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    //
    protected $fillable = [
		'name', 'title', 'subtitle', 'linktitle', 'link', 'active',
	];

	// protected $table = 'covers';

}
