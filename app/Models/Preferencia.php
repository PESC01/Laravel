<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class Preferencia extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "preferencias";

    protected $fillable = [
        "preferencias_alimenticias",
        "preferencias_habitacion",
        "necesidades_especiales",
        "persona",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
