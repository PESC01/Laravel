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
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->date('fech_nac');
            $table->string('ci');
            $table->string('image')->nullable();
            $table->string('estado_civil');
            $table->unsignedBigInteger('nacionalidad');
            
            $table->unsignedBigInteger('genero');
            $table->text('motivo_ingreso');
            $table->string('firma_consentimiento');
            $table->date('fech_registro');
            $table->time('hora_registro', $precision = 0);

            $table->foreign('genero')->references('id')->on('generos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('nacionalidad')->references('id')->on('nacionalidades')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
