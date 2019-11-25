<?php

namespace App\Http\Requests;

class Instituicao extends AbstractApi
{
    protected $defaultRule = [
        'nome' => 'required|max:100',
        'status' => 'required',
    ];

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
        $rule = [];

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return $rule;
                break;
            }
            case 'POST':
            {
                $rule = [
                    'cnpj' => 'required|unique:instituicao',
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rule = [
                    'cnpj' => 'required|unique:instituicao,cnpj,'.$this->instituicao.',id',
                ];
                break;
            }
            default:break;
        }


        return array_merge($this->defaultRule, $rule);
    }

    public function messages()
    {
        return [
            'cnpj.required' => 'O campo cnpj é obrigatório',
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O campo nome tem limite de 100 caracteres',
            'status.required' => 'O campo status é obrigatório',
            'cnpj.unique' => 'Cnpj já cadastrado',
        ];
    }
}
