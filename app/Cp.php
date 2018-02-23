<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cp extends Model
{
	public $timestamps = false;
    protected $table = 'cp_autocomplete';
	
	public static function getListForCp($codePostal){
		return self::where('CP',$codePostal)->get()->pluck('VILLE','id')->toArray();
	}
}
