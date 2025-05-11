<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_type',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'name',
        'tax_rate'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'tax_rate' => 'decimal:2'
    ];

    // Relación con factura
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    // Relación polimórfica con productos (tanques o partes)
    public function product(): MorphTo
    {
        return $this->morphTo('product', 'product_type', 'product_id');
    }
}