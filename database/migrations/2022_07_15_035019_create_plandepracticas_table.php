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
        Schema::create('plandepracticas', function (Blueprint $table) {
            $table->id();
            $table->integer('practicas_id');
            $table->date('fecha_inicio');
            $table->decimal('calificacion',$precision = 8, $scale = 2)->nullable();    
            $table->integer('guias_user_id')->nullable();
            $table->integer('tutor_user_id')->nullable();
            $table->integer('estudiante_user_id')->nullable();
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('plandepracticas');
    }
};
