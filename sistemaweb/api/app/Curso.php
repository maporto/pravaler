<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'curso';
    protected $with = ['instituicao'];

	protected $fillable = [
        'nome',
        'duracao',
        'status',
        'instituicao',
    ];

    public function instituicao()
    {
        return $this->belongsTo(Instituicao::class, 'instituicao', 'id', 'instituicao');
    }
}
