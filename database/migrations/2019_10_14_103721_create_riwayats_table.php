<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('penanganan_id')->unsigned();
            $table->string('foto')->nullable();
            $table->boolean('status')->default(0);
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('penanganan_id')->references('id')->on('penanganans')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayats');
    }
}
