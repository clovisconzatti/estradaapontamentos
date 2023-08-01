<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCancelado extends Migration
{

    public function up()
    {
        Schema::table('movimento', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
            $table->string('ativo',3)->default('Sim');
        });
    }


}
