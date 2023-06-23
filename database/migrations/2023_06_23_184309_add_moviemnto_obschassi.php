<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoviemntoObschassi extends Migration
{
    public function up()
    {
        Schema::table('movimento', function(Blueprint $table){
            $table->string('obs',255)->nullable();
            $table->string('chassi',255)->nullable();
        });
    }
}
