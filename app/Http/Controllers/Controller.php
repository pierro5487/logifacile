<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
	 * @param $collection
	 * @return array
	 * retourne une liste pour select optgroup par ordre lettre alphabetique
	 */
	public function formatUcGroup($collection,$label,$secondLabel =null){
		$array = $collection->sortBy($label)->toArray();
		$liste = [];
		foreach ($array as $item){
			$firstLetter = strtoupper(substr($item[$label],0,1));
			$option = $item[$label];
			if(!empty($secondLabel)){
				$option .= ' '.$item[$secondLabel];
			}
			$liste[$firstLetter][] = $option;
		}
		return $liste;
	}
}
