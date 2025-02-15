<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Ocupacion extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes
    protected $table = "ocupaciones";
    protected $fillable = ['cama_id', 'persona_id', 'fecha_ocupacion', 'fecha_liberacion', 'estado'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function cama()
    {
        return $this->belongsTo(Cama::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
