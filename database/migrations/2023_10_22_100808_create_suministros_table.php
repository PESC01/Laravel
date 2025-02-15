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
        Schema::create('suministros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('cantidad');
            $table->unsignedBigInteger('proveedor');
            $table->unsignedBigInteger('tipo');

            $table->foreign('proveedor')->references('id')->on('proveedores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo')->references('id')->on('tipo_suministros')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suministros');
    }
};
