<?php

namespace App\Http\Controllers;


use App\Marque;
use App\Montage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class MarquesController extends Controller{
	
	public function index(){
		$marques = Marque::all();
		return view('marques.index',compact('marques'));
	}
	
	public function add(){
		return view('marques.add');
	}
	
	public function create(Request $request){
		$data = $request->all();
		$marque = new Marque();
		$marque->nom = ucfirst($data['marque']);
		if($marque->save()){
			Session::flash('success','Marque ajoutée');
			return redirect()->route('marques.index');
		}
		Session::flash('error','Une erreur est survenue');
		return redirect()->route('marques.add');
	}
	
	public function edit(Request $request,$idMarque){
		$marque = Marque::findOrFail($idMarque);
		$data = $request->all();
		if($request->isMethod('post')){
			$marque->nom = ucfirst($data['marque']);
			if($marque->save()){
				Session::flash('success','Marque modifiée');
				return redirect()->route('marques.index');
			}
			Session::flash('error','Une erreur est survenue');
			return redirect()->route('marques.edit');
		}
		return view('marques.edit',compact('marque'));
	}
	
	public function upload(Request $request){
		if(Gate::allows('view_admin')) {
			if ($request->isMethod('post')) {
				$data = $request->all();
				$file = $data['file'];
				$pathInfo = pathinfo($file);
				$fichierCsv = fopen($pathInfo['dirname'] . '/' . $pathInfo['basename'], 'r');
				while (($ligne = fgetcsv($fichierCsv)) !== false) {
					$marque = new Marque();
					$marque->id = $ligne[0];
					$marque->nom = $ligne[1];
					$marque->save();
				}
				fclose($fichierCsv);
			}
			return view('marques.upload');
		}
	}
}