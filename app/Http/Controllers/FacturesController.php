<?php

namespace App\Http\Controllers;

use App\Auto;
use App\Client;
use App\Components\FacturePdf;
use App\Facture;
use App\GroupeLigne;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturesController extends Controller
{
    public function add(Request $request){
		//on verifie si un client est choisi ou pas
		if($request->session()->exists('client')){
			//si oui on regarde si il y a déja une facture brouillon en cours
			$client = $request->session()->get('client');
			$brouillons = Facture::getFacture()->brouillon()->forClient($client['id'])->get();
			// et si il a des factures non payées
			$facturesNonReglees = [];
			//si pas de cas en attente on créer la facture
			if(count($brouillons) == 0 && count($facturesNonReglees) == 0){
				//on verifie que le client existe
				$facture = new Facture();
				$facture->date_document = Carbon::now('Europe/London');
				$facture->type = 'facture';
				$facture->etat = 'brouillon';
				$facture->numero = $facture->createNum();
				$facture->situation = 1;
				$facture->client_id = $client->id;
				$facture->nom_client = $client->fullName;
				$facture->adresse = $client->adress;
				$facture->adresse_comp = $client->adresse_comp;
				$facture->code_postal = $client->city->CP;
				$facture->ville = $client->city->VILLE;
				$facture->pays = $client->city->CODEPAYS;
				$facture->echeance = Carbon::now('Europe/london');
				$facture->date_document = Carbon::now('Europe/london');
				$facture->createur_id = Auth::id();
				$facture->is_auto_E = false;
				if ($facture->save()) {
					return redirect()->route('factures.edit', $facture->id);
				}else{
					$request->session()->flash('error','Une erreur est survenue pendant la création de la facture,veuillez réessayer');
				}
			}
			return view('factures.addFacture',compact('brouillons','facturesNonReglees'));
		}else{
			//si non on redirige vers une page de choix
			return redirect()->route('clients.choixClient',['redirect'=>'addFacture']);
		}
	}
	
	public function visualise(Facture $facture){
		$totaux = $facture->getTotaux(0);
		//on récupère les groupes avec leur ligne pour cette facture
		$groupes = GroupeLigne::where('document_id',$facture->id)->with('Ligne')->get();
		//on calcule le total de la facture
		//on créer la facture
		$pdf = new FacturePdf();
//		$pdf->setAutoE();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->infoFacture($facture);
		$pdf->client($facture);
		$pdf->lignes($groupes);
		$pdf->totauxFooter($totaux);
		$pdf->Output();
	}
	
	public function index(){
		$factures = Facture::paginate(10);
		return view('factures.index',compact('factures'));
	}
	
	public function delete(Request $request){
		$data = $request->all();
		$facture = Facture::findOrFail($data['idFacture']);
		$this->authorize('delete',$facture);
		if($facture->delete()){
			$request->session()->flash('success','Brouillon supprimé');
		}else{
			$request->session()->flash('error','Une erreur est survenue pendant la supression du document,veuillez réessayer');
		}
		return redirect()->back();
	}
	
	public function edit($idFacture,Request $request){
		$facture = Facture::where('id',$idFacture)->with('Lignes')->with('groupLignes')->first();
		$totaux = $facture->getTotaux();
		//on récupère les autos de ce client
		$client = $request->session()->get('client');
		$autos = $this->formatAutoList(Auto::where('client_id',$client->id)->with('marque')->with('modele')->get(),'immat');
		$this->authorize('edit',$facture);
		return view('factures.edit',compact('facture','totaux','autos'));
	}
	
	public function valide($idFacture,Request $request){
		$facture = Facture::find($idFacture);
		$this->authorize('valide',$facture);
		//on verifei que la facture ne soit pas à zéro
		if($facture->Totaux['totalHT'] <=  0){
			$request->session()->flash('error','Impossible de valider une facture à 0');
			return redirect()->back();
		}
		//on valide la facture
		$facture->etat = 'validé';
		$facture->validateur_id = Auth::id();
		$facture->date_validation = Carbon::now();
		if($facture->save()){
			return redirect()->route('reglements.add',$idFacture);
		}
		$request->session()->flash('error','Une erreur est survenue pendant la validation de la facture');
		return redirect()->back();
	}
}
