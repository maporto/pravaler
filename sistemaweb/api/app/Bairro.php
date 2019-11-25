<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    protected $table = 'bairro';

    /**
	 * The attributes that should be fillable for arrays.
	 *
	 * @var array
	 */
	protected $fillable = [
        'codigo',
        'uf',
        'nome',
    ];
}
