<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'product_type',
        'product_code',
        'message'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica con productos (tanques o partes)
    public function product()
    {
        return $this->morphTo('product', 'product_type', 'product_code', 'code');
    }
}