<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_type',
        'product_id',
        'rating',
        'review_text'
    ];

    protected $casts = [
        'rating' => 'integer'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica con productos (tanques o partes)
    public function product()
    {
        return $this->morphTo('product', 'product_type', 'product_id');
    }
}