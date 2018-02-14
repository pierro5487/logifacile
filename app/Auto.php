<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
	public $modele;
	public $marque;
	
	protected $fillable = [
		'marque_id',
		'model_id',
		'client_id',
		'immat',
		'kilometrage'
	];
	
	//jointure table marque
	public function marque(){
		return $this->hasOne('App\Marque','id','marque_id');
	}
	
	//jointure table modele
	public function modele(){
		return $this->hasOne('App\Modele','id','model_id');
	}
	
	//jointure table marque
	public function proprietaire(){
		return $this->hasOne('App\Client','id','client_id');
	}
	
	public function getAutoListForSearch($search){
		return $this
			->select('marques.nom as marque','autos.id','modeles.nom as modele','clients.lastname','clients.firstname','autos.immat')
			->join('marques', 'autos.marque_id', '=', 'marques.id')
			->join('modeles', 'autos.model_id', '=', 'modeles.id')
			->leftjoin('clients', 'autos.client_id', '=', 'clients.id')
			->where(function($query) use ($search) {
			$query->where('marques.nom', 'like', '%'.$search.'%')
				->orWhere('clients.lastname', 'like', '%'.$search.'%')
				->orWhere('autos.immat', 'like', '%'.$search.'%')
				->orWhere('modeles.nom', 'like', '%'.$search.'%');
		})->get();
	}
}
