<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
	use SoftDeletes;
	
	protected $dates = array('date_document','deleted_at');
	
	public function Lignes(){
		return $this->hasMany('App\LigneFacture','document_id','id');
	}
	
	public function reglements(){
		return $this->hasMany('App\Reglement','document_id','id');
	}
	
	public function getTotaux($remiseGlobale = 0){
		$totaux['totalHT'] = 0;          	// total HT hors remise
		$totaux['totalHTApresRemise'] = 0;			// total HT remisé
		$totaux['totalTvaRemise'] = 0;
		$totaux['totalRemise'] = 0;
		$totaux['totalTTC'] = 0;
		$totaux['totalEncaissement'] = 0 ;
		$totaux['tva'] = array();
		foreach ($this->Lignes as $ligne){
			//calcul du montant ht de la ligne
			$montantHT = $ligne->prix_unitaire_HT*$ligne->quantite;
			$totaux['totalHT'] += $montantHT;
			
			//calcul du montantHT remisée
			if(!empty($ligne->remise) && $ligne->remise != 0){
				$montantHTRemise = $montantHT*((100-$ligne->remise)/100);
				$totaux['totalRemise'] += $montantHT*($ligne->remise/100);
			}else{
				$montantHTRemise = $montantHT;
			}
			
			//calcul du montantHT avec la remise globale
			if($remiseGlobale != 0){
				$montantGlobaleHTRemise = $montantHTRemise*((100-$remiseGlobale)/100);
			}else{
				$montantGlobaleHTRemise = $montantHTRemise;
			}
			
			$totaux['totalHTApresRemise'] += $montantGlobaleHTRemise;
			
			//calcule du montant de la tva
			if(!isset($totaux['tva'][$ligne->taux_tva])){
				$totaux['tva'][$ligne->taux_tva] = 0;
			}
			$montantTva = $montantGlobaleHTRemise*$ligne->taux_tva/100;
			$totaux['totalTvaRemise'] += $montantTva;
			$totaux['tva'][$ligne->taux_tva] = array(
				'montant'	=> $montantTva,
				'base'		=> $montantGlobaleHTRemise
			);
			$totaux['totalTTC'] = $totaux['totalTTC']+$montantTva+$montantGlobaleHTRemise;
		}
		$totaux['encaissements'] = $this->reglements;
		foreach ($totaux['encaissements'] as $encaissement) {
			$totaux['totalEncaissement'] += $encaissement['montant'];
		}
		$totaux['netAPaye'] = $totaux['totalTTC'] - $totaux['totalEncaissement'];
		return $totaux;
	}
	
	/*-----------------------------------------------*/
	/*                     scope                     */
	/*-----------------------------------------------*/
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les brouillons
	 */
	public function scopeBrouillon($query){
		return $query->where('etat','brouillon');
	}
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les document validés
	 */
	public function scopeValide($query){
		return $query->where('etat','validé');
	}
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les docs de type facture
	 */
	public function scopeGetFacture($query){
		return $query->where('type','facture');
	}
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les docs de type avoir
	 */
	public function scopeGetAvoir($query){
		return $query->where('type','avoir');
	}
	
	/**
	 * @param $query
	 * @return mixed
	 * rrecherche suelement les docs de type devis
	 */
	public function scopeGetDevis($query){
		return $query->where('type','devis');
	}
	
	/**
	 * @param $query
	 * @param $idClient
	 * @return mixed
	 * retourne seulement les docs appartenant au client donné
	 */
	public function scopeForClient($query,$idClient){
		return $query->where('client_id',$idClient);
	}
	
}
