<?php

namespace App\Http\Controllers;

use App\Curso as CursoEntity;
use App\Http\Requests\Curso as CursoRequest;
use App\Http\Resources\CursoCollection;
use App\Http\Resources\CursoResource;

class CursoController extends Controller
{
    public function getList(CursoRequest $request) {
        $query = $this->processaQuery($request);
        $colecao = CursoEntity::where($query)->orderBy('created_at', 'desc')->get();
        $retorno = new CursoCollection($colecao);

        return $retorno;
	}

	public function create(CursoRequest $request) {
        $params = $request->validated();
        $params['instituicao'] = $params['instituicao']['id'];
        $curso = CursoEntity::create($params);

        return new CursoResource(CursoEntity::findOrFail($curso->id));
    }

	public function get(CursoRequest $request, $encomenda) {
        return new CursoResource(CursoEntity::findOrFail($encomenda));
	}

	public function update(CursoRequest $request, $curso) {
        $entidade = CursoEntity::findOrFail($curso);
        $params = $request->validated();
        $entidade->update($params);
		return new CursoResource($entidade);
    }

	public function delete(CursoRequest $request, $curso) {
        $entidade = CursoEntity::findOrFail($curso);
		$entidade->delete();
		return response()->json(true, 204);
    }

    protected function processaQuery($request)
    {
        $queryProcessada = [];
        $query = $request->query();

        if (isset($query['instituicao']) && $query['instituicao']) {
            $queryProcessada[] = [
                'instituicao',
                '=',
                $query['instituicao']
            ];
        }

        return $queryProcessada;
    }
}
