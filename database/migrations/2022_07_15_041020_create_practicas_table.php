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
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->text('completencia');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->decimal('cantidad_horas',$precision = 8, $scale = 2)->nullable();
            $table->decimal('calificacion',$precision = 8, $scale = 2)->nullable();
            $table->integer('carreras_id');
            $table->integer('ciclos_id');
            $table->enum('estadopractica',['Pendiente','En Curso','Terminado'])->default('Pendiente');
            $table->integer('estudiantes_id')->nullable();
            $table->integer('docenteguias_id')->nullable();
            $table->integer('docentetutores_id')->nullable();
            $table->integer('guias_user_id')->nullable();
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
        Schema::dropIfExists('practicas');
    }
};
