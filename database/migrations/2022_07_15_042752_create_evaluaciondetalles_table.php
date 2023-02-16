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
        Schema::create('evaluaciondetalles', function (Blueprint $table) {
            $table->id();
            $table->integer('valoracioncolaborativas_id');
            $table->integer('variablevaloraciones_id');
            $table->integer('evaluaciones_id');
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
        Schema::dropIfExists('evaluaciondetalles');
    }
};