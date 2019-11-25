<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estado';

    /**
	 * The attributes that should be fillable for arrays.
	 *
	 * @var array
	 */
	protected $fillable = [
        'codigouf',
        'uf',
        'nome',
        'regiao',
    ];
}
