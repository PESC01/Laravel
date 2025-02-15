<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes

class Medicamento extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = "medicamentos";

    protected $fillable = [
        "nombre_medicamento",
        "descripcion",
        "cantidad",
        "tipo",
        "proveedor",
    ];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function tipo()
    {
        return $this->belongsTo(TipoMedicamento::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function suministrosMedicamento()
    {
        return $this->hasMany(SuministroMedicamento::class);
    }
}
