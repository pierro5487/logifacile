<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    protected $dates = array('date');
	protected  $guarded = [];
	
	/*-----------------------------------------------*/
	/*                     scope                     */
	/*-----------------------------------------------*/
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les brouillons
	 */
	public function scopeForDate($query,$date){
		return $query->where('date','>=',$date.' 00:00:00')->where('date','<=',$date.' 23:59:59');
	}
	
	
}
