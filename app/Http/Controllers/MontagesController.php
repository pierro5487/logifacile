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
			dd($data);
			return json_encode(array('success' => true));
		}
	}
}