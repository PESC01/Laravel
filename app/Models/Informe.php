<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Informe extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $fillable = [
        'persona_id',
        'titulo',
        'contenido',
        'pdf_path',
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
