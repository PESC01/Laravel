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
        Schema::create('registro_visitas_medicas', function (Blueprint $table) {
            $table->id();
            $table->text('documentación');
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
        Schema::dropIfExists('registro_visitas_medicas');
    }
};
