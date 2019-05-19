<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kass', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_kas');
            $table->bigInteger('nomor_kas');
            $table->string('costumer');
            $table->string('nota');
            $table->decimal('harga', 13, 2);
            $table->string('jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_kass');
    }
}
