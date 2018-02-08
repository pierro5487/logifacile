<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Montage extends Model {
	
	public function getLibelle(){
		$libelle = 'Montage';
		//equilabre
		if($this->equilibrage){
			$libelle .= '/Equilibrage';
		}
		//valve
		if($this->valve){
			$libelle .= '/Valve';
		}
		//size
		$libelle .= ' '.$this->size.'"';
		//alu
		if($this->alu){
			$libelle .= ' alu';
		}else{
			$libelle .= ' tôle';
		}
		//runflat
		if($this->runflat){
			$libelle .= ' runflat';
		}
		//truck
		if($this->truck){
			$libelle .= ' camionette';
		}
		return $libelle;
	}
	
	/**
	 * @param $query
	 * @param $data
	 * @return mixed
	 * scope pour récuperer le prix d'apres les options choisies
	 */
	public function scopeMontagePrice($query,$data){
		$query->where('size',$data['size'])->where('montage',1);
		//equilabre
		if($data['equilibrage'] == 'true'){
			$query->where('equilibrage',1);
		}else{
			$query->where('equilibrage',0);
		}
		//valve
		if($data['valve'] == 'true'){
			$query->where('valve',1);
		}else{
			$query->where('valve',0);
		}
		//alu
		if($data['alu'] == 'true'){
			$query->where('alu',1);
		}else{
			$query->where('alu',0);
		}
		//runflat
		if($data['runflat'] == 'true'){
			$query->where('runflat',1);
		}else{
			$query->where('runflat',0);
		}
		//truck
		if($data['truck'] == 'true'){
			$query->where('truck',1);
		}else{
			$query->where('truck',0);
		}
		return $query;
	}
}