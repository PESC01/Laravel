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
        Schema::create('historial_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicamentos');
            $table->text('medicamentos_anteriores_recetados');
            $table->string('dosis_duracion_medicacion');
            $table->unsignedBigInteger('persona');

            $table->foreign('persona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('medicamentos')->references('id')->on('medicamentos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medicamentos');
    }
};
