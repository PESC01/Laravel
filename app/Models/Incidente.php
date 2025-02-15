<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Incidente extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "incidentes";

    protected $fillable = [
        "incidente_fecha",
        "incidente_descripcion",
        "persona",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
