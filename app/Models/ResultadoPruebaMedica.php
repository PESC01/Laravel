<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class ResultadoPruebaMedica extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "resultados_pruebas_medicas";

    protected $fillable = [
        "descripcion_prueba_medica",
        "fecha_prueba_medica",
        "persona"
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
