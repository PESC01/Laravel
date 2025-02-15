<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class Adoptante extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "adoptantes";

    protected $fillable = [
        "nombres",
        "apellidos",
        "celular",
        "domicilio",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
