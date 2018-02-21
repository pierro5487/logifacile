<?php

namespace App\Http\Controllers;


use App\Cp;
use Symfony\Component\HttpFoundation\Request;

class CpController extends Controller{
	
	public function add(Request $request){
		$data = $request->all();
		$cp = new Cp();
		if($request->ajax()){
			if(preg_match('/^[0-9]{5}$/',trim($data['cp']))){
				$cp->CODEPAYS = 'FR';
				$cp->CP = trim($data['cp']);
			}elseif(preg_match('/^([a-zA-Z])[0-9]{4}$/',trim($data['cp']),$matches)){
				$cp->CP = trim($data['cp']);
				if(strtoupper($matches[1]) == 'L') {
					$cp->CODEPAYS = 'LU';
				}elseif(strtoupper($matches[1]) == 'B'){
					$cp->CODEPAYS = 'BE';
				}elseif(strtoupper($matches[1]) == 'D'){
					$cp->CODEPAYS = 'DE';
				}
			}else{
				return json_encode(array('success' => false,'message'=> 'Code postal non valide'));
			}
			//test si ville valide
			if(isset($data['ville']) && !empty($data['ville'])){
				$cp->VILLE = ucfirst($data['ville']);
			}else{
				return json_encode(array('success' => false,'message'=> 'Ville non valide'));
			}
			//on regarde si cela existe
			$exist = Cp::where('VILLE',ucfirst($data['ville']))->where('CP',trim($data['cp']))->count();
			if(!$exist){
				//sauvegarde
				if($cp->save()){
					return json_encode(array('success' => true,'cp' => $cp));
				}
				return json_encode(array('success' => false,'message'=> 'Une erreur est survenue pendant l\'enregistrement'));
			}
			return json_encode(array('success' => false,'message'=> 'Cette ville existe déja'));
			
		}
	}
}