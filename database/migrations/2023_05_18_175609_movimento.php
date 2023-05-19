<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Movimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimento', function(Blueprint $table){
            $table->increments('id');
            $table->date('data')->nullable();
            $table->integer('pessoa')->nullable();
            $table->integer('doc')->nullable();
            $table->integer('produto')->nullable();
            $table->string('movimento',1)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('movimento');
    }
}
