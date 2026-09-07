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
use Illuminate\Support\Facades\Storage;

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
        'email_verified_at',
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

    public function setNameAttribute($value)
    {
        $this->attributes['nombre'] = $value;
    }

    public function getPasswordAttribute()
    {
        return $this->contrasena;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['contrasena'] = $value;
    }

    public function getIdAttribute()
    {
        return $this->id_usuario;
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->profile?->profile) {
            return Storage::disk('public')->url($this->profile->profile);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=059669&color=fff&size=256';
    }
    
    // Accessor para mantener compatibilidad con 'password'
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}
