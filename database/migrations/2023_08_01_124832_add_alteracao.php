<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlteracao extends Migration
{

    public function up()
    {
        Schema::table('movimento', function (Blueprint $table) {
            $table->integer('user_alteracao_id')->after('user_id')->nullable();
        });
    }

}
