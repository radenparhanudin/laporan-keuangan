<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanKlisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_klises', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_klise');
            $table->bigInteger('nomor_klise');
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
        Schema::dropIfExists('laporan_klises');
    }
}
