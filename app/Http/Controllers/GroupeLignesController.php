<?php

namespace App\Http\Controllers;

use App\Auto;
use App\GroupeLigne;
use App\Http\Requests\addAutoHeaderRequest;
use App\Http\Requests\DeleteHeaderGroupeRequest;

class GroupeLignesController extends Controller{
	
	public function deleteHeader(DeleteHeaderGroupeRequest $request){
		$data = $request->all();
		$groupe = GroupeLigne::where('id',$data['idGroupe'])->first();
		if($groupe->document_id == $data['idFacture']){
			$groupe->auto_id = null;
			$groupe->no_header = '1';
			$groupe->immatriculation = null;
			$groupe->auto_string = null;
			$groupe->kilometrage;
			if($groupe->save()){
				return json_encode(array('success' => true,'message' => 'Auto supprimé de la facture'));
			}
			return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
		}
		return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
	}
	
	public function addAutoHeader(addAutoHeaderRequest $request){
		$data = $request->all();
		//on recupere l'auto
		$auto = Auto::where('id',$data['auto'])->with('modele')->with('marque')->first();
		$groupe = GroupeLigne::where('id',$data['idGroupe'])->first();
		if($groupe->document_id == $data['idFacture']){
			$groupe->auto_id = $data['auto'];
			$groupe->no_header = '0';
			$groupe->immatriculation = $auto->immat;
			$groupe->auto_string = $auto->Marque->nom.' '.$auto->Modele->nom;
			$groupe->kilometrage = $data['kilometrage'];
			if($groupe->save()){
				return json_encode(array('success' => true,'message' => 'Auto ajouté à la facture','auto' => $auto));
			}
			return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
		}
		return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
		
	}
}