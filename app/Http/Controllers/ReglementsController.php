<?php

namespace App\Http\Controllers;


use App\Facture;
use App\Http\Requests\AddReglementRequest;
use App\Reglement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class ReglementsController extends Controller{
	
	protected $optionsReglement = array(
			'carte bancaire' 	=> 'Carte bancaire',
			'especes'			=> 'Especes',
			'cheques'			=> 'Cheques',
			'pertes'			=> 'Pertes'
		);
	
	public function add(Facture $facture){
		$this->authorize('ajoutReglement',$facture);
		$optionsReglement = $this->optionsReglement;
		return view('reglements.add',compact('facture','optionsReglement'));
	}
	
	public function create(Request $request,Facture $facture){
		$data = $request->all();
		$validator = Validator::make($data, [
			'montant' => 'required|numeric|min:1|max:'.$facture->totaux['solde'],
			'mode_reglement' => 'in:'.implode(',',array_keys($this->optionsReglement)),
		]);

		if ($validator->fails()) {
			return redirect()->route('reglements.add',$facture->id)
				->withErrors($validator)
				->withInput();
		}else{
			$reglement = new Reglement();
			$reglement->montant = $data['montant'];
			$reglement->document_id = $facture->id;
			$reglement->mode_reglement = $data['mode_reglement'];
			$reglement->date = Carbon::now();
			$reglement->note = isset($data['note'])?$data['note']:null;
			if($reglement->save()){
				$request->session()->flash('success','Reglement ajouté');
				return redirect()->route('factures.index');
			}else{
				$request->session()->flash('error','erreur pendant l\'enregistrement');
				return redirect()->route('reglements.add',$facture->id);
			}
		}
	}
}