<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->bigInteger('paket_id')->unsigned()->nullable()->after('no_transaksi');
            $table->foreign('paket_id')->references('id')->on('pakets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->dropForeign('reservasi_paket_id_foreign');
            $table->dropColumn('paket_id');
        });
    }
}
