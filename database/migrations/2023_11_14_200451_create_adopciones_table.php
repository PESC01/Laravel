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
        Schema::create('adopciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('adoptante');
            $table->unsignedBigInteger('persona');
            $table->string('motivo');
            $table->string('estado');
            $table->string('observaciones');

            $table->foreign('adoptante')->references('id')->on('adoptantes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('persona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adopciones');
    }
};
