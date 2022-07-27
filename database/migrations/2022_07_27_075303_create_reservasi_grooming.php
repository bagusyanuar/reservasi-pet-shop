<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasiGrooming extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi_grooming', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('reservasi_id')->unsigned();
            $table->bigInteger('kucing_id')->unsigned();
            $table->smallInteger('transport')->default(0);
            $table->text('alamat');
            $table->timestamps();
            $table->foreign('reservasi_id')->references('id')->on('reservasi');
            $table->foreign('kucing_id')->references('id')->on('kucings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi_grooming');
    }
}
