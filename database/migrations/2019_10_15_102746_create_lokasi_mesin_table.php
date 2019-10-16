<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiMesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_mesin', function (Blueprint $table) {
            $table->smallInteger('lokasi_id')->unsigned();
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onUpdate('cascade')->onDelete('cascade');
            $table->smallInteger('mesin_id')->unsigned();
            $table->foreign('mesin_id')->references('id')->on('mesins')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['mesin_id', 'lokasi_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lokasi_mesin', function (Blueprint $table) {
            //
        });
    }
}
