<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa', function(Blueprint $table){
            $table->increments('id');
            $table->integer('codfocco')->unique();
            $table->string('nome',50)->nullable();
            $table->string('cliente',3)->nullable();
            $table->string('fornecedor',3)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pessoa');
    }
}
