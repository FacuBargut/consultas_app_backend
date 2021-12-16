<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnoConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno_consultas', function (Blueprint $table) {
            $table->unsignedInteger('id_consulta');
            $table->foreign('id_consulta')->references('id')->on('consultas');
            $table->unsignedInteger('id_alumno');
            $table->foreign('id_alumno')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno_consultas');
    }
}
