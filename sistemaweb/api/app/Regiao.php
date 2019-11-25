<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regiao';

    /**
	 * The attributes that should be fillable for arrays.
	 *
	 * @var array
	 */
	protected $fillable = [
        'nome'
    ];
}
