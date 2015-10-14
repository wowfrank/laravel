<?php

namespace Netcafe\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable = [
		'title', 'description', 'status',
	];

	public static function getRandomNum( $min = 1, $total) {
        $groupList      = range(1, 4);
        $numberList     = range($min, $total);
        $result         = [];
        $currentKey     = '';
        foreach($numberList as $key=>$value) {
            $result[ceil($value/4)][$key] = $value;
        }
        foreach($result as $key=>$value) {
            shuffle($groupList);
            $result[$key]['shuffle'] = $groupList;
        }
        // dd($result);
        return $result;
    }
}
