<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_pengaduan', 25)->nullable();
            $table->smallInteger('mesin_id')->unsigned();
            $table->smallInteger('lokasi_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('foto')->nullable();
            $table->boolean('status')->default(0);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('mesin_id')->references('id')->on('mesins')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('lokasi_id')->references('id')->on('lokasis')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaduans');
    }
}
