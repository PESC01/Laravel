<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class Persona extends Model
{
    use HasFactory, SoftDeletes; // Incluir SoftDeletes

    protected $dates = ['deleted_at']; // Agregar campo de soft delete

    protected $table = "personas";

    protected $fillable = [
        "nombres",
        "apellidos",
        "fech_nac",
        "ci",
        "image",
        "estado_civil",
        "nacionalidad",
        "genero",
        "motivo_ingreso",
        "firma_consentimiento",
        "fech_registro",
        "hora_registro",
    ];

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class);
    }

    public function contacto()
    {
        return $this->belongsTo(Contacto::class);
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }

    public function informes()
    {
        return $this->hasMany(Informe::class, 'persona_id');
    }
}
