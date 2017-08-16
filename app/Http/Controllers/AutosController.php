<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\AutoRequest;
use App\Marque;
use Illuminate\Http\Request;

class AutosController extends Controller
{
    public function add(){
    	/**récupéres les marques**/
		$marques = $this->formatUcGroup(Marque::all(),'nom');
		$clients = $this->formatUcGroup(Client::all(),'lastname','firstname');
    	return view('autos.add',compact('marques','clients'));
	}
	
	public function sauve(AutoRequest $request){
		
	}
}
