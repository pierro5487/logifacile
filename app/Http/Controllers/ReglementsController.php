<?php

namespace App\Http\Controllers;


use App\Facture;

class ReglementsController extends Controller{
	
	public function add(Facture $facture){
		$this->authorize('ajoutReglement',$facture);
		return view('reglements.add',compact('facture'));
	}
}