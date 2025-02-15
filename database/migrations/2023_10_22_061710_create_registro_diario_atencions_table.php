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
        Schema::create('registro_diario_atenciones', function (Blueprint $table) {
            $table->id();
            $table->text('actividades_paciente_descripcion');
            $table->date('fecha');
            $table->unsignedBigInteger('persona');

            $table->foreign('persona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_diario_atenciones');
    }
};
