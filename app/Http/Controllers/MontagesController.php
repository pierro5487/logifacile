<?php

namespace App\Http\Controllers;


use App\Montage;
use Illuminate\Http\Request;

class MontagesController extends Controller{
	
	public function config(){
		$datas = Montage::all();
		$montages = [];
		foreach ($datas as $data){
			$montages[$data->size][] = $data;
		}
		return view('montages.config',compact('montages'));
	}
	
	public function update(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$montage = Montage::find($data['idMontage']);
			if($montage && is_numeric($data['prix'])){
				$montage->valeur = $data['prix'];
				if($montage->save()){
					return json_encode(array('success' => true));
				}else{
					return json_encode(array('success' => false,'message' => 'une erreur est survenue pendant l\'enregistrement'));
				}
			}
			return json_encode(array('success' => false,'message'=> 'ce montage n\'existe pas'));
		}
	}
}