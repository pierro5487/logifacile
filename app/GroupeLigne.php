<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupeLigne extends Model
{
	use SoftDeletes;
	protected $fillable = [
		'document_id',
		'createur_id',
		'no_header',
		'auto_id',
		'immatriculation',
		'kilometrage',
		'date_document',
	];
	
	// this is a recommended way to declare event handlers
	protected static function boot() {
		parent::boot();
		
		static::deleting(function($groupe) { // before delete() method call this
			$groupe->ligne()->delete();
			// do the rest of the cleanup...
		});
	}
	
	protected $dates = array('date_document');
	
    public function ligne(){
		return $this->hasMany('App\LigneFacture','groupe_lignes_id','id');
	}
	
	public function auto(){
		return $this->belongsTo('App\Auto', 'auto_id', 'id');
	}
}
