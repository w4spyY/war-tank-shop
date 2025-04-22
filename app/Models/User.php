<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'nacimiento',
        'email',
        'password',
        'direccion',
        'facturacion',
        'telefono',
        'terms_accepted',
        'cookies_accepted',
        'role',
    ];

    /**
     * Los atributos que deben estar ocultos al serializar.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben convertirse automáticamente.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'nacimiento' => 'date',
        'terms_accepted' => 'boolean',
        'cookies_accepted' => 'boolean',
    ];

    /**
     * Comprobar si el usuario es admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
