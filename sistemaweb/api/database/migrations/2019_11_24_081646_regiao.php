<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Regiao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regiao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
        });
        DB::connection()->getPdo()->exec("
            Insert into Regiao (Id, Nome) values (1, 'Norte');
            Insert into Regiao (Id, Nome) values (2, 'Nordeste');
            Insert into Regiao (Id, Nome) values (3, 'Sudeste');
            Insert into Regiao (Id, Nome) values (4, 'Sul');
            Insert into Regiao (Id, Nome) values (5, 'Centro-Oeste');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regiao');
    }
}
