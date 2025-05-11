<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'nacimiento' => 'date',
        'terms_accepted' => 'boolean',
        'cookies_accepted' => 'boolean',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Relación con carritos
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relación con facturas
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Relación con consultas de productos
    public function productInquiries()
    {
        return $this->hasMany(ProductInquiry::class);
    }

    // Relación con valoraciones
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}