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
        Schema::create('variablevaloraciones', function (Blueprint $table) {
            $table->id();
            $table->enum('creterios_evaluacion',['Persistencia','Satisfacción','Percepción'])->default('Persistencia');
            $table->enum('perfil',['Estudiante','Docente guia','Docente tutor'])->default('Estudiante');
            $table->text('preguntas');
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
        Schema::dropIfExists('variablevaloraciones');
    }
};
