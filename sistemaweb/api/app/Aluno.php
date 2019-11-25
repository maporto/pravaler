<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'aluno';
    protected $with = ['curso', 'estado', 'cidade', 'bairro'];

	protected $fillable = [
        'nome',
        'cpf',
        'dataNascimento',
        'celular',
        'email',
        'status',
        'curso',
        'endereco',
        'estado',
        'cidade',
        'bairro',
        'numero',
    ];
    protected $dates = ['dataNascimento'];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado');
    }

    public function cidade()
    {
        return $this->belongsTo(Municipio::class, 'cidade');
    }

    public function bairro()
    {
        return $this->belongsTo(Bairro::class, 'bairro');
    }
}
