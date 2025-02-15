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
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_medicamento');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->unsignedBigInteger('tipo');
            $table->unsignedBigInteger('proveedor');

            $table->foreign('tipo')->references('id')->on('tipo_medicamentos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('proveedor')->references('id')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos');
    }
};
