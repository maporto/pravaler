<?php

namespace App\Http\Requests;

class Curso extends AbstractApi
{
    protected $defaultRule = [
        'nome' => 'required|max:100',
        'duracao' => 'required',
        'status' => 'required|max:1',
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
                $rule['instituicao.id'] = 'exists:instituicao,id';
                break;
            }
            case 'PUT':
            case 'PATCH':
            default:break;
        }


        return array_merge($this->defaultRule, $rule);
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O campo nome tem limite de 100 caracteres',
            'status.max' => 'O campo nome tem limite de 1 caracteres',
            'status.required' => 'O campo status é obrigatório',
            'duracao.required' => 'O campo duracao é obrigatório',
            'instituicao.id.exists' => 'Instituição não existe',
            'instituicao.id.required' => 'O campo instituicao é obrigatório',
        ];
    }
}
