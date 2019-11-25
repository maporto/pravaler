<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';

    /**
	 * The attributes that should be fillable for arrays.
	 *
	 * @var array
	 */
	protected $fillable = [
        'codigo',
        'nome',
        'uf',
    ];
}
