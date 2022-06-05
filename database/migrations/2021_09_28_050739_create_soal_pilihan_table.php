<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalPilihanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_pilihan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('jawaban');
            $table->text('media')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreignUuid('soal_id')->on('soal')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_pilihan');
    }
}
