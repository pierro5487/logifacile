<?php

namespace App\Http\Controllers;

use App\Modele;
use Illuminate\Http\Request;

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
}
