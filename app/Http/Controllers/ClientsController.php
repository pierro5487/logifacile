<?php

namespace App\Http\Controllers;

use App\Auto;
use App\Client;
use App\Cp;
use App\Facture;
use App\Http\Requests\ChoixClientRequest;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClientsController extends Controller
{
    public function add(){
        return view('clients.add');
    }
	
	/**
	 * @param Request $request
	 * @return string
	 * retourne la liste des villes suivant le code postal tapé
	 */
    public function searchCP(Request $request){
       if($request->ajax()){
           $data = $request->all();
           $search = $data['search'];
           $codePostaux = Cp::where('CP','LIKE',$search)->get()->pluck('VILLE','id');
           return json_encode($codePostaux);
        }
    }
    
    public function view($idClient){
		$client = Client::findOrFail($idClient);
		$autos = Auto::where('client_id',$idClient)->with('modele')->with('marque')->get();
		//on recupères les factures brouillons
		$brouillons = Facture::getFacture()->valide()->forClient($client['id'])->get();
		// et si il a des factures non payées
		$facturesNonReglees = Facture::getFacturesNonRegle($client['id']);
		return view('clients.view',compact('client','autos','brouillons','facturesNonReglees'));
	}
	
	/**
	 * @param ClientRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 * sauvegarde le client
	 * redirection differente possible
	 */
    public function sauve(ClientRequest $request){
    	$data = $request->all();
		$data['lastname'] = strtoupper($data['lastname']);
		$data['firstname'] = ucfirst($data['firstname']);
		
		if($client = Client::create($data)){
			Session::flash('success','Client ajouté');
			//choix de la redirection
			if($data['direction'] == 'save'){
				return redirect()->route('clients.liste');
			}else{
				//ON ECRIT LE client en session
				$request->session()->put('client',$client);
				$request->session()->flash('success','Nouveau Client choisi');
				if($data['direction'] == 'auto'){
					return redirect()->route('autos.add',['client'=>1]);
				}
				return redirect()->route('clients.liste');
			}
		}else{
			Session::flash('error','Une erreur est survenue pendant l\'enregistrement');
		}
		return view('clients.add');
	}
	
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * liste tous les clients
	 */
	public function liste(){
		$clients = Client::with('city')->get();
		return view('clients.liste',compact('clients'));
	}
	
	public function edit($idClient){
		$client = Client::where('id',$idClient)->with('city')->first();
		$villes = Cp::where('CP',$client->city->CP)->get()->pluck('VILLE','id')->toArray();
		return view('clients.edit',compact('client','villes'));
	}
	
	public function update(ClientRequest $request,$idClient){
		$data = $request->all();
		$client = Client::find($idClient);
		if($client->update($data)){
			Session::flash('success','Client modifié');
			return redirect()->route('clients.liste');
		}else{
			Session::flash('error','Une erreur est survenue pendant l\'enregistrement');
		}
	}
	
	public function searchClient(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$search = $data['search'];
			$clientManager = new Client();
			$clients = $clientManager->getClientListForSearch($search);
			return view('elements.clients.clientList',compact('clients'));
		}
	}
	
	/**
	 * @param ChoixClientRequest $request
	 * @param null $redirect
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
	 * permet de changer le client en cours(session)
	 * redirect sert à la redirection (option)
	 */
	public function choixClient(ChoixClientRequest $request,$redirect = null){
		
		//on récupère la liste complete des clients
		$clients = $this->formatUcGroup(Client::all(),'lastname','firstname');
		//on récupère la liste des assurances
		$assureurs = [];
		//soumission formulaire
		if($request->isMethod('post')){
			$data = $request->all();
			//on récupère le client choisi
			$client = Client::where('id',$data['client_id'])->first();
//			//on enregistre en session
			$request->session()->put('client',$client);
			$request->session()->flash('success','Nouveau Client choisi');
			//on redirige vers la page précedente
			if($redirect == 'addFacture'){
				return redirect()->route('factures.add');
			}else{
				return redirect('/');
			}
		}
		return view('clients.choixClient',compact('clients','assureurs'));
	}
	
	public function upload(Request $request){
		if(Gate::allows('view_admin')) {
			if ($request->isMethod('post')) {
				$data = $request->all();
				$file = $data['file'];
				$pathInfo = pathinfo($file);
				$fichierCsv = fopen($pathInfo['dirname'] . '/' . $pathInfo['basename'], 'r');
				while (($ligne = fgetcsv($fichierCsv)) !== false) {
					$client = new Client();
					$client->id = $ligne[0];
					$client->firstname = $ligne[1];
					$client->lastname = $ligne[2];
					$client->email = $ligne[3];
					$client->adress = $ligne[4];
					$client->id_city = $ligne[5];
					$client->phone = $ligne[6];
					$client->created_at = $ligne[7];
					$client->save();
				}
				fclose($fichierCsv);
			}
			return view('clients.upload');
		}
	}
}
