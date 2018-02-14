<?php

namespace App\Http\Controllers;

use App\Facture;
use App\Http\Requests\AddCustomLigneRequest;
use App\Http\Requests\AddDecalaminageRequest;
use App\Http\Requests\AddMontageRequest;
use App\Http\Requests\UpdateAutoRequest;
use App\Http\Requests\UpdateLigneRequest;
use App\LigneFacture;
use App\Montage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LigneFacturesController extends Controller
{
	/**
	 * @param AddDecalaminageRequest $request
	 * @return string
	 * ajoute une ligne correspondant à la facturation d'un décalaminage
	 */
    public function addDecalaminage(AddDecalaminageRequest $request){
		$data = $request->all();
		$newLigne = array(
			'groupe_lignes_id'	=> $data['idGroupe'],
			'remise'			=> $data['remise'],
			'taux_tva'			=> 0,
			'prix_unitaire_HT' 	=> $data['prix'],
			'quantite'			=> $data['quantite'],
			'libelle'			=> 'Décalaminage moteur',
			'document_id'		=> $data['idFacture'],
			'date_document'		=> Carbon::now(),
			'createur_id'		=> Auth::id()
		);
		return $this->saveLigne($newLigne);
	}
	
	public function addCustomLigne(AddCustomLigneRequest $request){
		$data = $request->all();
		$newLigne = array(
			'groupe_lignes_id'	=> $data['idGroupe'],
			'remise'			=> $data['remise'],
			'taux_tva'			=> 0,
			'prix_unitaire_HT' 	=> $data['prix'],
			'quantite'			=> $data['quantite'],
			'libelle'			=> $data['libelle'],
			'document_id'		=> $data['idFacture'],
			'date_document'		=> Carbon::now(),
			'createur_id'		=> Auth::id()
		);
		return $this->saveLigne($newLigne);
	}
	
	public function addMontage(AddMontageRequest $request){
		$data = $request->all();
		//on recupère le prix
		$price = Montage::montagePrice($data)->first();
		//on prepare le libelle
		$libelle = $price->getLibelle();
		//on regarde combien de ligne faut il creer
		if($data['quantite'] == 1){
			if($data['situation'] == 'AVAR'){
				return json_encode(array('situation' => array('Pour une quantite 1 ,la situation ne peut être que AV ou AR')));
			}
			$libelle .= ' '.$data['situation'];
			
		}elseif($data['quantite'] == 2){
			$libelle .= ' '.$data['situation'];
		}else{
			$libelle .= ' AVAR';
		}
		$newLigne = array(
			'groupe_lignes_id'	=> $data['idGroupe'],
			'remise'			=> 0,
			'taux_tva'			=> 0,
			'prix_unitaire_HT' 	=> $price->valeur,
			'quantite'			=> $data['quantite'],
			'libelle'			=> $libelle,
			'document_id'		=> $data['idFacture'],
			'date_document'		=> Carbon::now(),
			'createur_id'		=> Auth::id()
		);
		return $this->saveLigne($newLigne);
	}
	
	private function saveLigne($newLigne,$idLigne =  null){
		if(!empty($idLigne)){
			//on met a jour la ligne
			unset($newLigne['createur_id']);
			unset($newLigne['date_document']);
			
		}else{
			//on créer la ligne
			if($ligne = LigneFacture::create($newLigne)){
				$sousTotalGroupe = $ligne->getTotalGroupe($ligne->groupe_lignes_id);
				$facture = Facture::where('id',$ligne->document_id)->with('Lignes')->first();
				$totaux = $facture->getTotaux();
				return json_encode(array('success' => true,'ligne' => $ligne,'sousTotalGroupe' => $sousTotalGroupe,'totaux' => $totaux));
			}
			return json_encode(array('success' => false,'message' => 'Une erreur est survenue pendant l\'enregistrement'));
		}
	}
	
	public function updateLigne(UpdateLigneRequest $request){
		$data = $request->all();
		$ligne = LigneFacture::where('id',$data['idLigne'])->first();
		$ligne->libelle = $data['libelle'];
		$ligne->remise = $data['remise'];
		$ligne->prix_unitaire_HT = $data['prix'];
		$ligne->quantite = $data['quantite'];
//		$ligne->taux_tva = $data['tva'];
		if($ligne->save()){
			$sousTotalGroupe = $ligne->getTotalGroupe($ligne->groupe_lignes_id);
			$facture = Facture::where('id',$ligne->document_id)->with('Lignes')->first();
			$totaux = $facture->getTotaux();
			return json_encode(array('success' => true,'ligne' => $ligne,'sousTotalGroupe' => $sousTotalGroupe,'totaux' => $totaux));
		}
		return json_encode(array('success' => false,'message' => 'Une erreur est survenue pendant l\'enregistrement'));
	}
	
	/**
	 * @param Request $request
	 * @return string
	 * supprime les lignes
	 */
	public function deleteLigne(Request $request){
		$data = $request->all();
		if(isset($data['idLigne'])){
			$ligne = LigneFacture::where('id',$data['idLigne'])->with('document')->first();
			$this->authorize('delete',$ligne->document);
			if($ligne->delete()){
				$sousTotalGroupe = $ligne->getTotalGroupe($ligne->groupe_lignes_id);
				$facture = Facture::where('id',$ligne->document_id)->with('Lignes')->first();
				$totaux = $facture->getTotaux();
				return json_encode(array('success' => true,'idGroupe' => $ligne->groupe_lignes_id,'sousTotalGroupe' => $sousTotalGroupe,'totaux' => $totaux));
			}else{
				return json_encode(array('success' => false,'message'=> 'Une erreur s\'est produite pendant la suppression'));
			}
		}else{
			return json_encode(array('success'=> false,'message'=> 'Une erreur est survenue : données manquantes'));
		}
	}
}
