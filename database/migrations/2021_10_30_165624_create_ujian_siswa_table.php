<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->dateTime('mulai');
            $table->dateTime('selesai');
            $table->decimal('nilai')->nullable();
            $table->text('user_agent');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->foreignUuid('ujian_id')->on('ujian')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignUuid('siswa_id')->on('siswa')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian_siswa');
    }
}
