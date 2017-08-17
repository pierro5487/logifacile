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
	
	public function getClientListForSearch($search){
		return $this
			->select('cp_autocomplete.VILLE','clients.id','clients.lastname','clients.firstname')
			->join('cp_autocomplete', 'clients.id_city', '=', 'cp_autocomplete.id')
//			->join('modeles', 'autos.model_id', '=', 'modeles.id')
//			->leftjoin('clients', 'autos.client_id', '=', 'clients.id')
			->where(function($query) use ($search) {
				$query->where('clients.firstname', 'like', '%'.$search.'%')
					->orWhere('clients.lastname', 'like', '%'.$search.'%')
					->orWhere('cp_autocomplete.VILLE', 'like', '%'.$search.'%');
			})->get();
	}
}
