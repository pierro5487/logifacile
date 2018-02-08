<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LigneFacture extends Model
{
	use SoftDeletes;
	
    public $table = 'lignesfactures';
	
	protected $fillable = array(
		'groupe_lignes_id',
		'remise',
		'taux_tva',
		'prix_unitaire_HT',
		'quantite',
		'libelle',
		'document_id',
		'date_document',
		'createur_id'
	);
	
	protected $dates = array('date_document');
	
	public function document(){
		return $this->hasOne('App\Facture','id','document_id');
	}
	
	/**
	 * @param $idGroupe
	 * @return int
	 * retourne le total d'un groupe de lignes
	 */
	public function getTotalGroupe($idGroupe){
		$total = 0;
		$lignes = $this->where('groupe_lignes_id',$idGroupe)->get();
		foreach($lignes as $ligne){
			$total += $ligne->quantite*($ligne->prix_unitaire_HT*(100-$ligne->remise)/100);
		}
		return $total;
	}
}
