<?php

namespace App\Http\Requests;

use App\Aluno as AlunoEntity;

class Aluno extends AbstractApi
{
    protected $defaultRule = [
        'email' => 'required|email',
        'celular' => 'required',
        'dataNascimento' => 'required|date',
        'nome' => 'required|max:100',
        'estado.id' => 'required|exists:estado,id',
        'cidade.id' => 'required|exists:municipio,id',
        'bairro.id' => 'exists:bairro,id',
        'endereco' => 'max:200',
        'numero' => 'required',
        'status' => 'required|max:1'
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
                return [];
                break;
            }
            case 'POST':
            {
                $rule = [
                    'cpf' => 'required|unique:aluno,cpf',
                    'curso.id' => 'required|exists:curso,id',
                ];
                break;
            }
            case 'PUT':
            case 'PATCH':
            {
                $rule = [
                    'cpf' => 'required|unique:aluno,cpf,'.$this->aluno.',id',
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
            'cpf.required' => 'O campo cpf é obrigatótrio',
            'numero.required' => 'O campo numero é obrigatótrio',
            'celular.required' => 'O campo celular é obrigatótrio',
            'dataNascimento.required' => 'O campo dataNascimento é obrigatótrio',
            'nome.required' => 'O campo nome é obrigatótrio',
            'estado.id.required' => 'O campo estado é obrigatótrio',
            'cidade.id.required' => 'O campo cidade é obrigatótrio',
            'endereco.required' => 'O campo endereco é obrigatótrio',
            'numero.required' => 'O campo numero é obrigatótrio',
            'status.required' => 'O campo status é obrigatótrio',
            'curso.id.required' => 'O campo curso é obrigatótrio',
            'estado.id.exists' => 'Estado não cadastrado',
            'cidade.id.exists' => 'Cidade não cadastrada',
            'bairro.id.exists' => 'Bairro não cadastrado',
            'curso.id.exists' => 'Curso não cadastrado',
            'cpf.unique' => 'Cpf ja cadastrado',
            'endereco.max' => 'O campo endereco permite no maximo 200 caracteres',
            'nome.max' => 'O campo endereco permite no maximo 100 caracteres',
            'endereco.status' => 'O campo endereco permite no maximo 1 caracteres',
            'dataNascimento.date' => 'O campo dataNascimento esta no formato errado',
        ];
    }
}
