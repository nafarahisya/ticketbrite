<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKomentarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_acara');
            $table->foreign('id_acara')->references('id')->on('acara')->onDelete('cascade')->onUpdate('cascade');;
            $table->text('isi');
            $table->unsignedInteger('komentar_ke')->nullable();
            $table->unsignedInteger('id_member')->nullable();
            $table->foreign('id_member')->references('id')->on('member');
            $table->unsignedInteger('id_panitia')->nullable();
            $table->foreign('id_panitia')->references('id')->on('panitia')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('komentar');
    }
}
