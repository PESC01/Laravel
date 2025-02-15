<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class HistorialMedicamentos extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "historial_medicamentos";

    protected $fillable = [
        "medicamentos",
        "medicamentos_anteriores_recetados",
        "dosis_duracion_medicacion",
        "persona",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
