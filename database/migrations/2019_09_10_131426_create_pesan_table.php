<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',191);
            $table->string('nohp',20);
            $table->string('alamat',191);
            $table->string('email',191)->unique();
            $table->string('kode_pesanan',6)->nullable();
            $table->string('nomor_rekening',20)->nullable();
            $table->string('bank_pengirim',20)->nullable();
            $table->string('bank_tujuan',20)->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->integer('kode_unik')->nullable();
            $table->string('gambar_konfirmasi',191)->nullable();
            $table->integer('status')->default('0');
            $table->unsignedInteger('id_member');
            $table->foreign('id_member')->references('id')->on('member')->nullable();
            $table->unsignedInteger('id_acara');
            $table->foreign('id_acara')->references('id')->on('acara')->nullable()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pesan');
    }
}
