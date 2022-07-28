<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipeReservasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasi', function (Blueprint $table) {
            $table->enum('tipe', ['grooming', 'penitipan'])->after('no_transaksi')->default('grooming');
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
            $table->dropColumn('tipe');
        });
    }
}
