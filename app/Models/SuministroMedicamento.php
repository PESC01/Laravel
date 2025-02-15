<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar SoftDeletes
use Carbon\Carbon;

class SuministroMedicamento extends Model
{
    use HasFactory, SoftDeletes; // Agregar SoftDeletes

    protected $table = 'suministros_medicamentos';

    protected $fillable = ['medicamento_id', 'cantidad'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class);
    }

    // Accessor para usar la misma zona horaria que la configurada en la app
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(config('app.timezone'));
    }
}
