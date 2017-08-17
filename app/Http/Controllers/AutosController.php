<?php

namespace App\Http\Controllers;

use App\Auto;
use App\Client;
use App\Http\Requests\AutoRequest;
use App\Http\Requests\UpdateAutoRequest;
use App\Marque;
use App\Modele;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AutosController extends Controller
{
    public function add(){
    	/**récupéres les marques**/
		$marques = $this->formatUcGroup(Marque::all(),'nom');
		$clients = $this->formatUcGroup(Client::all(),'lastname','firstname');
    	return view('autos.add',compact('marques','clients'));
	}
	
	public function sauve(AutoRequest $request){
		$data = $request->all();
		if(Auto::create($data)){
			Session::flash('success','Auto ajoutée');
		}else{
			Session::flash('error','Une erreur s\'est produite');
		}
		return redirect()->route('autos.index');
	}
	
	public function index(){
		$autos = Auto::with('proprietaire','marque','modele')->get();
		return view('autos.index',compact('autos'));
	}
	
	public function edit(Auto $auto){
		$marques = $this->formatUcGroup(Marque::all(),'nom');
		$clients = $this->formatUcGroup(Client::all(),'lastname','firstname');
		$modeles = $this->formatUcGroup(Modele::where('id',$auto->model_id)->get(),'nom');
		return view('autos.edit',compact('auto','marques','clients','modeles'));
	}
	
	public function update(UpdateAutoRequest $request,$idAuto){
		$data = $request->all();
		$auto = Auto::find($idAuto);
		if($auto->update($data)){
			Session::flash('success','Auto modifié');
			return redirect()->route('autos.index');
		}else{
			Session::flash('error','Une erreur est survenue pendant l\'enregistrement');
		}
	}
	
	public function searchAuto(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$search = $data['search'];
			$autoManager = new Auto();
			$autos = $autoManager->getAutoListForSearch($search);
			return view('elements.autos.autoList',compact('autos'));
		}
	}
}
