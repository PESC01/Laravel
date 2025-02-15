<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class Adopcion extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "adopciones";

    protected $fillable = [
        "fecha",
        "adoptante",
        "persona",
        "motivo",
        "estado",
        "observaciones",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
