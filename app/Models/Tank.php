<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory;

    protected $table = 'tanks';

    protected $fillable = [
        'code',
        'image_url',
        'category_id',
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
        'stock',
        'sells'
    ];

    protected $casts = [
        'manufacture_year' => 'integer',
        'weight_kg' => 'decimal:2',
        'max_speed_kmh' => 'decimal:2',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'sells' => 'integer',
        'crew_capacity' => 'integer',
        'fuel_capacity_liters' => 'integer',
        'horsepower' => 'integer',
        'range_km' => 'integer',
    ];

    // Relación con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relación con las reseñas
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'product', 'product_type', 'product_id');
    }

    // Relación con las consultas
    public function inquiries()
    {
        return $this->morphMany(ProductInquiry::class, 'product', 'product_type', 'product_code', 'code');
    }

    // Relación con items de carrito
    public function cartItems()
    {
        return $this->morphMany(CartItem::class, 'product', 'product_type', 'product_id');
    }

    // Relación con items de factura
    public function invoiceItems()
    {
        return $this->morphMany(InvoiceItem::class, 'product', 'product_type', 'product_id');
    }
}