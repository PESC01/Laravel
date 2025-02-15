<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Seguimiento extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "seguimientos";

    protected $fillable = [
        "presion_arterial",
        "frecuencia_cardiaca",
        "temperatura",
        "fecha_seguimiento",
        "persona"
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
