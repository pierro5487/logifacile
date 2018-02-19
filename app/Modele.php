<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
	public  $fillable = [
		'nom',
		'marque_id'
	];
	
	public function marque(){
		return $this->hasOne('App\Marque','id','marque_id');
	}
}
