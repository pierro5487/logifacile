<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoRequest extends FormRequest
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
//        	'client_id'	=> 'exists:clients,id',
            'marque_id' => 'exists:marques,id',
			'model_id' 	=> 'exists:modeles,id|nullable',
//			'immat'		=> 'regex:#^([A-Za-z][A-Za-z]?-[0-9]{2}[0-9]?-[A-Za-z]{2})|([0-9]{3}-[A-Za-z]{3}-[0-9]{2})|[A-Za-z]{2}[0-9]{4}$#'
        ];
    }
}
