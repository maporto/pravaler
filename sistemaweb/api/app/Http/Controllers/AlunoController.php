<?php

namespace App\Http\Controllers;

use App\Aluno as AlunoEntity;
use App\Http\Requests\Aluno as AlunoRequest;
use App\Http\Resources\AlunoResource;
use App\Http\Resources\AlunoCollection;

class AlunoController extends Controller
{
    public function getList(AlunoRequest $request) {
        $query = $this->processaQuery($request);
        $colecao = AlunoEntity::where($query)->orderBy('nome')->get();
        $retorno = new AlunoCollection($colecao);

        return $retorno;
	}

	public function create(AlunoRequest $request) {
        $params = $request->validated();
        $params['curso'] = $params['curso']['id'];
        $params = $this->processaParametros($params);
        $aluno = AlunoEntity::create($params);

        return new AlunoResource(AlunoEntity::findOrFail($aluno->id));
    }

	public function get(AlunoRequest $request, $encomenda) {
        return new AlunoResource(AlunoEntity::findOrFail($encomenda));
	}

	public function update(AlunoRequest $request, $aluno) {
        $entidade = AlunoEntity::findOrFail($aluno);
        $params = $request->validated();
        $params = $this->processaParametros($params);
        $entidade->update($params);
		return new AlunoResource($entidade);
    }

	public function delete(AlunoRequest $request, $aluno) {
        $entidade = AlunoEntity::findOrFail($aluno);
		$entidade->delete();
		return response()->json(true, 204);
    }

    public function processaParametros(&$parametros)
    {
        $parametros['estado'] = $parametros['estado']['id'];
        $parametros['cidade'] = $parametros['cidade']['id'];
        $parametros['bairro'] = $parametros['bairro'] ? $parametros['bairro']['id'] : null;

        return $parametros;
    }

    protected function processaQuery($request)
    {
        $queryProcessada = [];
        $query = $request->query();

        if (isset($query['nome']) && $query['nome']) {
            $queryProcessada[] = [
                'nome',
                'like',
                "%".str_replace(" ", "%", strtoupper(strip_tags($query['nome'])))."%"
            ];
        }

        if (isset($query['curso']) && $query['curso']) {
            $queryProcessada[] = [
                'curso',
                '=',
                $query['curso']
            ];
        }

        return $queryProcessada;
    }
}
