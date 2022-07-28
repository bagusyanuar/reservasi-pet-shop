<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservasi_grooming', function (Blueprint $table) {
            $table->text('catatan')->default('-')->after('alamat');
            $table->time('jam')->nullable()->after('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservasi_grooming', function (Blueprint $table) {
            $table->dropColumn('catatan');
            $table->dropColumn('jam');
        });
    }
}
