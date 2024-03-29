<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('nis');
            $table->string('password');
            $table->string('jenis_kelamin');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreignUuid('level_id')->on('levels')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignUuid('domain_id')->on('domain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
