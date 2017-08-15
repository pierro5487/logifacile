<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $fillable = [
		'firstname',
		'lastname',
		'email',
		'adress',
		'id_city',
		'phone',
		'type',
	];
	
	public function getFullNameAttribute() {
		return mb_strtoupper($this->lastname) . ' ' . ucfirst($this->firstname);
	}
	
	//jointure table city
	public function city(){
		return $this->hasOne('App\Cp','id','id_city');
	}
}
