<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acara', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_acara',191);
            $table->string('nama_acara',191);
            $table->text('deskripsi');
            $table->string('kota',100);
            $table->string('lokasi',191);
            $table->string('kategori',50);
            $table->string('cp',20);
            $table->integer('maksimal');
            $table->integer('tanggal');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->unsignedInteger('id_panitia');
            $table->foreign('id_panitia')->references('id')->on('panitia')->nullable();
            $table->integer('status');
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('acara');
    }
}
