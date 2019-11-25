<?php

namespace App\Http\Controllers;

use App\Instituicao as InstituicaoEntity;
use App\Http\Requests\Instituicao as InstituicaoRequest;
use App\Http\Resources\InstituicaoCollection;
use App\Http\Resources\InstituicaoResource;

class InstituicaoController extends Controller
{
    public function getList() {
		return new InstituicaoCollection(InstituicaoEntity::orderBy('nome')->get());
	}

	public function create(InstituicaoRequest $request) {
        $params = $request->validated();
        $instituicao = InstituicaoEntity::create($params);
        return new InstituicaoResource($instituicao);
    }

	public function get(InstituicaoRequest $request, $instituicao) {
        return new InstituicaoResource(InstituicaoEntity::findOrFail($instituicao));
	}

	public function update(InstituicaoRequest $request, $instituicao) {
        $entidade = InstituicaoEntity::findOrFail($instituicao);
        $params = $request->validated();
        $entidade->update($params);
		return new InstituicaoResource($entidade);
    }

	public function delete(InstituicaoRequest $request, $instituicao) {
        $entidade = InstituicaoEntity::findOrFail($instituicao);
		$entidade->delete();
		return response()->json(true, 204);
    }
}
