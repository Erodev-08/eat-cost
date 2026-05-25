<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    // Especificar el nombre de la tabla si es diferente
    protected $table = 'users';
    
    // Especificar la llave primaria si no es 'id'
    protected $primaryKey = 'id_usuario';
    
    // Los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',        // En lugar de 'name'
        'email',
        'contrasena',    // En lugar de 'password'
        'institution',
        'rol'
    ];
    
    // Ocultar estos campos al serializar
    protected $hidden = [
        'contrasena',    // En lugar de 'password'
        'remember_token',
    ];
    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación con profile
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'id_user', 'id_usuario');
    }
    
    // Mutador para establecer fecha_registro automáticamente
    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->rol) {
                $user->rol = 'estudiante';
            }
        });
    }
    
    // Accessor para mantener compatibilidad con nombre 'name'
    public function getNameAttribute()
    {
        return $this->nombre;
    }
    
    // Accessor para mantener compatibilidad con 'password'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
