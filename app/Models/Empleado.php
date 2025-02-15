<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "empleados";

    protected $fillable = [
        "nombres",
        "apellidos",
        "ci",
        "celular",
        "calificaciones",
        "certificaciones",
        "antecedentes",
        "user_id",
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
