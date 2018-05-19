<?php

namespace App\Http\Controllers;

use App\Auto;
use App\GroupeLigne;
use App\Http\Requests\addAutoHeaderRequest;
use App\Http\Requests\DeleteHeaderGroupeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

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
			$groupe->date_document = Carbon::createFromFormat('d/m/Y', $data['dateAddAuto'])->format('Y-m-d');
			if($groupe->save()){
				return json_encode(array('success' => true,'message' => 'Auto ajouté à la facture','auto' => $auto));
			}
			return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
		}
		return json_encode(array('success' => false,'message' => 'le groupe ne correspond pas à la facture'));
		
	}
	
	public function addNewGroupe(Request $request,$idFacture){
		//on creer le groupe
		$groupe = new GroupeLigne();
		$groupe->document_id = $idFacture;
		$groupe->createur_id = Auth::id();
		$groupe->no_header = '1';
		$groupe->date_document = Carbon::now();
		if(!$groupe->save()){
			$request->session()->flash('error','Une erreur s\'est produite à la création du sous-total');
		}else{
			$request->session()->flash('success','nouveau sous-total créé');
		}
		return redirect()->back();
	}
	
	public function deleteGroupe(Request $request,GroupeLigne $groupe){
		if(!$groupe->delete()){
			$request->session()->flash('error','Une erreur s\'est produite à la suppression du sous-total');
		}else{
			//on supprime également les lignes
			$request->session()->flash('success','sous-total supprimé');
		}
		return redirect()->back();
	}
}