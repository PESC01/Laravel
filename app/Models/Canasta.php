<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Canasta extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $fillable = ['fecha', 'persona_id', 'estado'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
