<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupeLigne extends Model
{
	public $dates = array('date_document');
	
    public function ligne(){
		return $this->hasMany('App\LigneFacture','groupe_lignes_id','id');
	}
	
	public function auto(){
		return $this->belongsTo('App\Auto', 'auto_id', 'id');
	}
}
