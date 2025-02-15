<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class TipoMedicamento extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "tipo_medicamentos";

    protected $fillable = [
        "nombre_medicamento",
        "descripcion",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
