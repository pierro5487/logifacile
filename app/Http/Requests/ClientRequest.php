<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' 	=> 'required|min:3',
			'firstname' => 'required|min:3',
//			'email'		=> 'email',
			'phone'		=> 'required|regex:#[0-9+]#|min:8',
			'adress'	=> 'required|min:3',
			'id_city'	=> 'required|numeric',
			'type'		=> 'required|required',
        ];
    }
    
    public function message(){
    	return [
    		'id_city.required' 	=> 'Vous devez choisir une ville'
		];
	}
	
}
