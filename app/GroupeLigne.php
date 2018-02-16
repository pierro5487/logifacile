<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeLigne extends Model
{
	
	protected $fillable = [
		'document_id',
		'createur_id',
		'no_header',
		'auto_id',
		'immatriculation',
		'kilometrage',
		'date_document',
	];
	
	protected $dates = array('date_document');
	
    public function ligne(){
		return $this->hasMany('App\LigneFacture','groupe_lignes_id','id');
	}
	
	public function auto(){
		return $this->belongsTo('App\Auto', 'auto_id', 'id');
	}
}
