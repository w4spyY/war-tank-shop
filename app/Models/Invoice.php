<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'subtotal',
        'tax',
        'total',
        'status',
        'payment_method',
        'billing_name',
        'billing_address',
        'billing_tax_id'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'status' => 'string'
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con items de factura
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // Relación con pagos
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}