<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    use HasFactory;

    protected $table = "contactos";

    protected $fillable = [
        "nombres",
        "apellidos",
        "direccion_vivienda",
        "celular",
        "tipo_relacion",
        "persona",
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
