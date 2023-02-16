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
        Schema::create('intitucioneducativas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('numero')->nullable();
            $table->text('direccion')->nullable();
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
        Schema::dropIfExists('intitucioneducativas');
    }
};
