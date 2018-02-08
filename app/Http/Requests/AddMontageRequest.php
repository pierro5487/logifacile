<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMontageRequest extends FormRequest
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
			'quantite' 	=> 'required|integer|min:1|max:4',
			'idGroupe'	=> 'required|exists:lignesfactures,id',
			'idFacture'	=> 'required|exists:factures,id',
//			'valve'		=> 'booleen',
//			'equilibrage'	=> 'booleen',
			'size'		=> 'required|integer|min:14|max:21',
			'situation' => 'required|',
//			'alu'		=> 'boolean',
//			'truck'		=> 'boolean',
//			'runflat'	=> 'boolean'
			
		];
    }
}
