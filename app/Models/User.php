<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tabla personalizada existente en la BD
     */
    protected $table = 'usuariosistema';

    /**
     * Atributos asignables
     */
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    /**
     * Ocultar atributos en serialización
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Mutator: asegurar hashing de contraseña si se setea en texto plano.
     */
    public function setPasswordAttribute($value)
    {
        if (! empty($value)) {
            // si ya viene hasheada (empieza con $2y$) la dejamos, sino la hasheamos
            if (strpos($value, '$2y$') === 0 || strpos($value, '$argon2') === 0) {
                $this->attributes['password'] = $value;
            } else {
                $this->attributes['password'] = Hash::make($value);
            }
        }
    }

    /**
     * Devuelve true si el usuario tiene exactamente ese rol.
     */
    public function hasRole(string $role): bool
    {
        return isset($this->rol) && $this->rol === $role;
    }

    /**
     * Devuelve true si el usuario tiene cualquiera de los roles pasados.
     * $roles puede ser array o string separado por comas o pipes.
     */
    public function hasAnyRole($roles): bool
    {
        if (is_string($roles)) {
            // permisivo con separadores , o |
            $roles = preg_split('/[,\|]/', $roles);
        }

        if (!is_array($roles)) {
            return $this->hasRole((string)$roles);
        }

        foreach ($roles as $r) {
            if ($this->hasRole(trim($r))) {
                return true;
            }
        }

        return false;
    }
}
