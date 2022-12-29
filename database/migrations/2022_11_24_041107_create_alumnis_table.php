<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->char('jurusan_id', 5);
            $table->char('tracer_answer_id')->nullable();
            $table->string('foto')->nullable();
            $table->char('nisn', 15);
            $table->char('nik', 20);
            $table->char('nis', 10);
            $table->string('name', 50);
            $table->string('email');
            $table->bigInteger('nomer');
            $table->integer('tahun_lulus');
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
        Schema::dropIfExists('alumnis');
    }
}
