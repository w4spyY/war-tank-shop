<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TankPart extends Model
{
    use HasFactory;

    protected $table = 'tanks_parts';

    protected $fillable = [
        'code',
        'category_id',
        'name',
        'description',
        'material',
        'compatibility_notes',
        'weight_kg',
        'price',
        'stock',
        'sells',
        'image_url'
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'sells' => 'integer',
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