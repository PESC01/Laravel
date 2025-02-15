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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('celular');
            $table->string('calificaciones')->nullable();
            $table->string('certificaciones')->nullable();
            $table->string('antecedentes')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Agregar columna user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Definir la relación

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
