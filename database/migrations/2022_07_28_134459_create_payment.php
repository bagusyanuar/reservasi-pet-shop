<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reservasi_id')->unsigned();
            $table->string('bank');
            $table->string('no_rekening');
            $table->string('nama');
            $table->text('bukti');
            $table->integer('total');
            $table->string('status');
            $table->text('keterangan');
            $table->timestamps();
            $table->foreign('reservasi_id')->references('id')->on('reservasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
