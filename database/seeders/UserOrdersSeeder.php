<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\Tank;
use App\Models\TankPart;

class UserOrdersSeeder extends Seeder
{
    public function run()
    {
        $users = User::factory()->count(5)->create(['role' => 'user']);

        $users->each(function ($user) {
            $invoices = Invoice::factory()
                ->count(rand(1, 5))
                ->create(['user_id' => $user->id]);

            $invoices->each(function ($invoice) {
                $itemsCount = rand(1, 4);
                for ($i = 0; $i < $itemsCount; $i++) {
                    $productType = rand(0, 1) ? 'tank' : 'part';
                    
                    if ($productType === 'tank') {
                        $product = Tank::inRandomOrder()->first();
                    } else {
                        $product = TankPart::inRandomOrder()->first();
                    }

                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'product_type' => $productType,
                        'product_id' => $product->id,
                        'quantity' => rand(1, 3),
                        'unit_price' => $product->price,
                        'total_price' => $product->price * rand(1, 3),
                        'name' => $product->name,
                        'tax_rate' => 21.00,
                    ]);
                }

                Payment::create([
                    'invoice_id' => $invoice->id,
                    'amount' => $invoice->total,
                    'payment_method' => ['credit_card', 'paypal', 'bank_transfer'][rand(0, 2)],
                    'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                    'status' => $invoice->status === 'paid' ? 'completed' : 'pending',
                    'paid_at' => $invoice->status === 'paid' ? now()->subDays(rand(1, 30)) : null,
                ]);

                $subtotal = $invoice->items->sum('total_price');
                $tax = $subtotal * 0.21;
                $invoice->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $subtotal + $tax,
                ]);
            });
        });

        $this->command->info('creado');
    }
}