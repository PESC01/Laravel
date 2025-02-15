<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class RegistroDiarioAtencion extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "registro_diario_atenciones";

    protected $fillable = [
        "actividades_paciente_descripcion",
        "fecha",
        "persona",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
