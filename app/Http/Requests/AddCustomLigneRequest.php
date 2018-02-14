<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomLigneRequest extends FormRequest
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
			'quantite' 	=> 'required|numeric|min:1',
			'prix'		=> 'required|numeric|min:1',
			'remise'	=> 'required|numeric',
			'libelle'	=> 'required',
			'idGroupe'	=> 'required|exists:groupe_lignes,id',
			'idFacture'	=> 'required|exists:factures,id'
		];
	}
}
