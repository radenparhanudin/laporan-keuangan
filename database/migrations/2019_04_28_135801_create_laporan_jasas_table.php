<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanJasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_jasas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_jasa');
            $table->bigInteger('nomor_jasa');
            $table->string('costumer');
            $table->string('nota');
            $table->decimal('harga', 13, 2);
            $table->string('keterangan');
            $table->string('penjelasan');
            $table->bigInteger('jumlah');
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
        Schema::dropIfExists('laporan_jasas');
    }
}
