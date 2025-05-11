<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_type',
        'product_id',
        'quantity',
        'price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2'
    ];

    // Relación con carrito
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación polimórfica con productos (tanques o partes)
    public function product()
    {
        // Mapeo de tipos para la relación polimórfica
        $mapping = [
            'tank' => 'App\Models\Tank',
            'part' => 'App\Models\TankPart'
        ];
        
        return $this->morphTo('product', 'product_type', 'product_id', 'id')
            ->whereIn('product_type', array_keys($mapping));
    }
}