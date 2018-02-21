<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddModeleRequest;
use App\Marque;
use App\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ModelesController extends Controller
{
    public function getModelesForMarque(Request $request){
    	$data = $request->all();
		if(!$request->ajax()){
			abort(403, 'Unauthorized action.');
		}
		$idMarque = $data['marque'];
		$models = Modele::where('marque_id',$idMarque)->get();
		return json_encode($this->formatUcGroup($models,'nom'));
	}
	
	public function index(){
		$modeles = Modele::all();
		return view('modeles.index',compact('modeles'));
	}
	
	public function add(){
		$marques = $this->formatUcGroup(Marque::all(),'nom');
		return view('modeles.add',compact('marques'));
	}
	
	public function create(AddModeleRequest $request){
		$data = $request->all();
		$modele = new Modele();
		$modele->nom = ucfirst($data['modele']);
		$modele->marque_id = $data['marque_id'];
		if($modele->save()){
			Session::flash('success','Modèle ajoutée');
			return redirect()->route('modeles.index');
		}
		Session::flash('error','Une erreur est survenue');
		return redirect()->route('modeles.add');
	}
	
	public function edit(Request $request,$idModele){
		$modele = Modele::findOrFail($idModele);
		$marques = $this->formatUcGroup(Marque::all(),'nom');
		return view('modeles.edit',compact('modele','marques'));
	}
	
	public function update(AddModeleRequest $request,$idModele){
		$data = $request->all();
		$modele = Modele::findOrFail($idModele);
		$modele->nom = ucfirst($data['modele']);
		$modele->marque_id = $data['marque_id'];
		if($modele->save()){
			Session::flash('success','Modèle modifiée');
			return redirect()->route('modeles.index');
		}
		Session::flash('error','Une erreur est survenue');
		return redirect()->route('modeles.edit');
	}
	
	public function upload(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			$file = $data['file'];
			$pathInfo = pathinfo($file);
			$fichierCsv = fopen($pathInfo['dirname'].'/'.$pathInfo['basename'],'r');
			while(($ligne = fgetcsv($fichierCsv)) !== false){
				$modele  = new Modele();
				$modele->id = $ligne[0];
				$modele->nom = $ligne[1];
				$modele->marque_id = $ligne[2];
				$modele->save();
			}
			fclose($fichierCsv);
		}
		return view('modeles.upload');
	}
}
