<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addAutoHeaderRequest extends FormRequest
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
			'idGroupe'	=> 'required|exists:groupe_lignes,id',
			'idFacture'	=> 'required|exists:factures,id',
            'kilometrage' 	=> 'required|integer',
			'auto'			=> 'required|exists:autos,id',
			'dateAddAuto'	=> 'required|date_format:d/m/Y'
        ];
    }
}
