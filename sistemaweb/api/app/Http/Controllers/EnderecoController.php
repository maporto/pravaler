<?php

namespace App\Http\Controllers;

use App\Estado;
use App\Http\Resources\EstadoCollection;
use App\Http\Resources\MunicipioCollection;
use App\Municipio;
use App\Bairro;
use App\Http\Resources\BairroCollection;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function getEstados(Request $request) {
		return new EstadoCollection(Estado::where($request->query())->get());
    }

    public function getMunicipios(Request $request) {
        $query = $this->processaQueryMunicipios($request);
		return new MunicipioCollection(Municipio::where($query)->get());
    }

    public function getBairros(Request $request) {
        $query = $this->processaQueryMunicipios($request);
		return new BairroCollection(Bairro::where($query)->get());
    }

    protected function processaQueryMunicipios($request)
    {
        $queryProcessada = [];
        $query = $request->query();

        if (isset($query['uf']) && $query['uf']) {
            $queryProcessada[] = [
                'uf',
                '=',
                $query['uf']
            ];
        }

        return $queryProcessada;
    }

    protected function processaQueryBairros($request)
    {
        $queryProcessada = [];
        $query = $request->query();

        if (isset($query['uf']) && $query['uf']) {
            $queryProcessada[] = [
                'uf',
                '=',
                $query['uf']
            ];
        }

        return $queryProcessada;
    }
}
