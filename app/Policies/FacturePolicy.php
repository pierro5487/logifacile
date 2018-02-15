<?php

namespace App\Policies;

use App\Facture;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FacturePolicy
{
    use HandlesAuthorization;
	
    
    public function delete(User $user,Facture $facture){
		if($facture->etat == 'brouillon'){
			return true;
		}
		return false;
	}
	
	public function edit(User $user,Facture $facture){
		if($facture->etat == 'brouillon'){
			return true;
		}
		return false;
	}
	
	public function valide(){
		return true;
	}
	
	public function ajoutReglement(User $user,Facture $facture){
		if($facture->etat == 'validé'){
			return true;
		}
		return false;
	}
}
