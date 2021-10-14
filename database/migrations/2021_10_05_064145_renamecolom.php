<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Renamecolom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
            Schema::create('krsbr', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('id_krs');
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
        // Schema::table('krs', function (Blueprint $table) {
        //     $table->renameColumn('krs', 'khs');
        // });
        //
    }
}
