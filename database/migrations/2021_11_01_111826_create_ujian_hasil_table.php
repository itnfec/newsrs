<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianHasilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_hasil', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('ujian_siswa_id')->unsigned();
            $table->string('soal_id')->unsigned();
            $table->string('jawaban')->nullable();
            $table->integer('ragu')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('ujian_hasil');
    }
}
