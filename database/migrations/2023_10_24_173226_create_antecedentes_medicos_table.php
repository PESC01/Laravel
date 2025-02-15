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
        Schema::create('antecedentes_medicos', function (Blueprint $table) {
            $table->id();
            $table->string('enfermedades_cronicas')->nullable();
            $table->string('alergias_medicamentos')->nullable();
            $table->string('cirugias_previas')->nullable();
            $table->string('historial_enfermedades')->nullable();
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
        Schema::dropIfExists('antecedentes_medicos');
    }
};
