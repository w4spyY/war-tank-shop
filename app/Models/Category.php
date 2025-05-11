<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description'
    ];

    // Relación con tanques
    public function tanks()
    {
        return $this->hasMany(Tank::class);
    }

    // Relación con partes de tanques
    public function tankParts()
    {
        return $this->hasMany(TankPart::class);
    }
}