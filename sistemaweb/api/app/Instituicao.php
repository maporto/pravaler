<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'instituicao';
    protected $with = [];

	protected $fillable = [
        'nome',
        'cnpj',
        'status',
    ];
}
