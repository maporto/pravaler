<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluno', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('cpf', 20)->unique();
            $table->date('dataNascimento');
            $table->string('celular');
            $table->string('email')->nullable();
            $table->string('status', 1);
            $table->string('endereco');
            $table->integer('curso')->unsigned();
            $table->foreign('curso')->references('id')->on('curso');
            $table->integer('estado')->unsigned();
            $table->foreign('estado')->references('id')->on('estado');
            $table->integer('cidade')->unsigned();
            $table->foreign('cidade')->references('id')->on('municipio');
            $table->integer('bairro')->unsigned()->nullable();
            $table->foreign('bairro')->references('id')->on('bairro');
            $table->integer('numero');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aluno');
    }
}
