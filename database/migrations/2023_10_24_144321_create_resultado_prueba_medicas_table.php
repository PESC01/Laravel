<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resultados_pruebas_medicas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion_prueba_medica');
            $table->date('fecha_prueba_medica');
            $table->unsignedBigInteger('persona');

            $table->foreign('persona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_pruebas_medicas');
    }
};
