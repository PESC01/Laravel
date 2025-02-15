<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class DocumentoLegal extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = 'documentos_legales'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'nombre_documento',
        'descripcion_documento',
        'imagen_documento',
        'persona_id',
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
