<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes; // Agregar

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes; // Agregar SoftDeletes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $appends = ['decrypted_password'];

    protected $dates = ['deleted_at']; // Agregar la fecha de borrado

    public function getDecryptedPasswordAttribute()
    {
        // Obtener la contraseña sin procesar de la base de datos
        return $this->attributes['password'];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adminlte_desc()
    {
        return $this->getRoleNames()->first() ?? 'Usuario';
    }

    public function adminlte_profile_url()
    {
        return 'user/profile';
    }

    public function adminlte_image()
    {
        return 'vendor/adminlte/dist/img/user2-160x160.jpg';
    }
}
