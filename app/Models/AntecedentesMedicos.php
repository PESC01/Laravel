<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class AntecedentesMedicos extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "antecedentes_medicos";

    protected $fillable = [
        "enfermedades_cronicas",
        "alergias_medicamentos",
        "cirugias_previas",
        "historial_enfermedades",
        "persona",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
