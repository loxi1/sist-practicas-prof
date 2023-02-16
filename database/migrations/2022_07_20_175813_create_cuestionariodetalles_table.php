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
        Schema::create('cuestionariodetalles', function (Blueprint $table) {
            $table->id();
            $table->integer('cuestionarios_id');
            $table->enum('variable',['Aplicativo web','Prácticas Pre Profesionales'])->default('Aplicativo web');
            $table->enum('dimension',['Software','Servicios','Objetivos','Tiempo','Evaluación y cumplimiento'])->default('Software');
            $table->enum('indicadores',['Servicios','Exactitud','Facilidad de aprendizaje','Satisfacción','Eficiencia','Indicador de competencias terminadas','Indicador de sesión de aprendizaje terminadas','Indicador de fecha de entrega de informes realizados','Indicador de fechas  de revisión realizadas','Indicador de autoevaluación','Indicador de la co-evaluación'])->default('Servicios');
            $table->integer('preguntas_id');
            $table->integer('rta');
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
        Schema::dropIfExists('cuestionariodetalles');
    }
};
