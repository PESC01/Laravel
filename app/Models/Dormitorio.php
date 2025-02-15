<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Dormitorio extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $fillable = ['nombre', 'capacidad', 'descripcion'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function camas()
    {
        return $this->hasMany(Cama::class);
    }
}
