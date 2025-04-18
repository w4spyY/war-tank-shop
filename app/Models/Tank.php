<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory;

    protected $table = 'tanks';

    protected $fillable = [
        'image_url',
        'name',
        'description',
        'weight_kg',
        'crew_capacity',
        'fuel_capacity_liters',
        'fuel_type',
        'horsepower',
        'ammunition_type',
        'max_speed_kmh',
        'price',
        'armor_type',
        'range_km',
        'manufacture_year',
        'country',
        'category',
        'stock',
    ];

    protected $casts = [
        'manufacture_year' => 'integer',
        'weight_kg' => 'decimal:2',
        'max_speed_kmh' => 'decimal:2',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'crew_capacity' => 'integer',
        'fuel_capacity_liters' => 'integer',
        'horsepower' => 'integer',
        'range_km' => 'integer',
    ];

    // Relación con las reseñas (un tanque tiene muchas reseñas)
    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }

    // Relación con las consultas (un tanque puede tener muchas consultas)
    public function inquiries()
    {
        return $this->hasMany(ProductInquiry::class, 'product_reference', 'id');
    }
}    