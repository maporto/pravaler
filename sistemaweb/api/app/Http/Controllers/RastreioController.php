<?php

namespace App\Http\Controllers;

use App\Encomenda;
use Illuminate\Http\Request;

class RastreioController extends Controller
{
    public function rastrear(Request $request)
    {
        return Encomenda::with(['paradas', 'cliente'])->where(['rastreio' => $request->query('rastreio')])->firstOrFail();
    }
}
