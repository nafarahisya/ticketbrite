<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanitiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panitia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_panitia',191);
            $table->string('foto',50)->nullable();
            $table->unsignedInteger('id_member');
            $table->foreign('id_member')->references('id')->on('member')->nullable();
            $table->string('alamat',191);
            $table->string('nohp',20);
            $table->string('url_image',191);
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('panitia');
    }
}
