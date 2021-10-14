<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Makekrsdua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('krsbaru', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_khs');
            $table->integer('id_mhs');
            $table->integer('id_jadwal');
            });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
