<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndicationRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:1',
            'cpf' => 'required|cpf|max:255|'.Rule::unique('indications')->ignore($this->id),
            'phone' => 'required|celular_com_ddd|max:255',
            'email' => 'required|email|string|max:255|min:1|'.Rule::unique('indications')->ignore($this->id),
        ];
    }

    public function messages()
    {

        return [
            'required' => 'Este campo é obrigatório',
            'max' => 'O máximo de caracteres são 255',
            'min' => 'O mínimo de caracteres é 1',
            'string' => 'Formato inválido',
            'cpf' => 'CPF inválido',
            'email' => 'E-mail inválido',
            'telefone' => 'Telefone inválido',
            'unique' => 'Dado já cadastrado'
        ];
    }

}
