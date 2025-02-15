<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class Cama extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $fillable = ['dormitorio_id', 'identificador'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function dormitorio()
    {
        return $this->belongsTo(Dormitorio::class);
    }

    public function ocupaciones()
    {
        return $this->hasMany(Ocupacion::class);
    }
}
