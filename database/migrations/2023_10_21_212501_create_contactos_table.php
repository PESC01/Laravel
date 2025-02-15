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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion_vivienda');
            $table->string('celular');
            $table->unsignedBigInteger('tipo_relacion');
            $table->unsignedBigInteger('persona');

            $table->foreign('tipo_relacion')->references('id')->on('tipo_relaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('persona')->references('id')->on('personas')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
