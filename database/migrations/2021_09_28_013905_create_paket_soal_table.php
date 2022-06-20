<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_soal', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul')->nullable();
            $table->string('author')->nullable();
            $table->text('publisher')->nullable();
            $table->integer('level')->nullable();
            $table->float('point')->nullable();
            $table->string('jenis')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->foreignUuid('kelas_id')->on('kelas')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignUuid('mapel_id')->on('mapel')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_soal');
    }
}
