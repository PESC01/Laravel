<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Suministro extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "suministros";

    protected $fillable = [
        "nombre",
        "descripcion",
        "cantidad",
        "proveedor",
        "tipo",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
