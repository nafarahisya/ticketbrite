<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_acara');
            $table->foreign('id_acara')->references('id')->on('acara')->nullable()->onDelete('cascade')->onUpdate('cascade');;
            $table->unsignedInteger('id_member');
            $table->foreign('id_member')->references('id')->on('member')->nullable();
            $table->unsignedInteger('id_pesan');
            $table->foreign('id_pesan')->references('id')->on('pesan')->nullable()->onDelete('cascade')->onUpdate('cascade');;
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
        Schema::dropIfExists('peserta');
    }
}
