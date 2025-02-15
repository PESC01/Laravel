<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Proveedor extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "proveedores";

    protected $fillable = [
        "nombres",
        "apellidos",
        "ci",
        "celular"
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado
}
