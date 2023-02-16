<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practicaestudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->integer('plandepracticas_id');
            $table->integer('estudiante_user_id')->nullable();
            $table->integer('tutor_user_id')->nullable();
            $table->enum('evaluacion_tutor',['Pendiente','Calificado'])->default('Pendiente');            
            $table->enum('evaluacion_estudiante',['Pendiente','Calificado'])->default('Pendiente');
            $table->string('observacion')->nullable();
            $table->datetime('fecha_evaluacion_tutor')->nullable();
            $table->datetime('fecha_evaluacion_estudiante')->nullable();
            $table->timestamps();
            $table->enum('estado',['Activo','Inactivo'])->default('Activo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicaestudiantes');
    }
};
