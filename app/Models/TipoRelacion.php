<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class TipoRelacion extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "tipo_relaciones";

    protected $fillable = [
        "nombre",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
