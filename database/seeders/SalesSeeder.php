<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        $users = DB::table('users')->limit(2)->get();
        if ($users->isEmpty()) {
            $this->command->error('Error');
            return;
        }

        $tanks = DB::table('tanks')->where('stock', '>', 0)->get();
        $parts = DB::table('tanks_parts')->where('stock', '>', 0)->get();
        
        if ($tanks->isEmpty() && $parts->isEmpty()) {
            $this->command->error('Error');
            return;
        }

        $invoiceStatuses = ['pending', 'paid', 'paid', 'paid', 'cancelled', 'refunded'];
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer'];
        
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $status = $invoiceStatuses[array_rand($invoiceStatuses)];
            $isPaid = $status === 'paid' || $status === 'refunded';
            $paymentMethod = $isPaid ? $paymentMethods[array_rand($paymentMethods)] : null;
            
            $invoiceId = DB::table('invoices')->insertGetId([
                'user_id' => $user->id,
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
                'subtotal' => 0,
                'tax' => 0,
                'total' => 0,
                'status' => $status,
                'payment_method' => $paymentMethod,
                'billing_name' => $user->name . ' ' . $user->lastname,
                'billing_address' => $user->direccion ?? 'Calle Falsa 123, Madrid, España',
                'billing_tax_id' => 'B' . mt_rand(10000000, 99999999),
                'created_at' => $now->copy()->subDays(rand(0, 30)),
                'updated_at' => $now->copy()->subDays(rand(0, 30)),
            ]);
            
            $subtotal = 0;
            $taxRate = 0.21;
            
            $itemsCount = rand(1, 5);
            $items = [];
            
            for ($j = 0; $j < $itemsCount; $j++) {
                $useTank = rand(0, 1) === 1 && !$tanks->isEmpty();
                
                if ($useTank) {
                    $product = $tanks->random();
                    $productType = 'tank';
                } else {
                    if ($parts->isEmpty()) {
                        continue;
                    }
                    $product = $parts->random();
                    $productType = 'part';
                }
                
                $quantity = rand(1, $productType === 'tank' ? 1 : 3);
                $unitPrice = $product->price;
                $totalPrice = $unitPrice * $quantity;
                $subtotal += $totalPrice;
                
                $items[] = [
                    'invoice_id' => $invoiceId,
                    'product_type' => $productType,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'name' => $product->name,
                    'tax_rate' => $taxRate,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
                
                if ($isPaid) {
                    if ($productType === 'tank') {
                        DB::table('tanks')
                            ->where('id', $product->id)
                            ->update([
                                'stock' => DB::raw('stock - ' . $quantity),
                                'sells' => DB::raw('sells + ' . $quantity),
                                'updated_at' => $now,
                            ]);
                    } else {
                        DB::table('tanks_parts')
                            ->where('id', $product->id)
                            ->update([
                                'stock' => DB::raw('stock - ' . $quantity),
                                'sells' => DB::raw('sells + ' . $quantity),
                                'updated_at' => $now,
                            ]);
                    }
                }
            }
            
            $tax = $subtotal * $taxRate;
            $total = $subtotal + $tax;
            
            DB::table('invoices')
                ->where('id', $invoiceId)
                ->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                ]);
            
            DB::table('invoice_items')->insert($items);
            
            if ($isPaid) {
                $paymentStatus = $status === 'refunded' ? 'refunded' : 'completed';
                $paidAt = $now->copy()->subDays(rand(0, 30));
                
                DB::table('payments')->insert([
                    'invoice_id' => $invoiceId,
                    'amount' => $total,
                    'payment_method' => $paymentMethod,
                    'transaction_id' => 'TXN-' . strtoupper(uniqid()),
                    'status' => $paymentStatus,
                    'paid_at' => $paidAt,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
        
        $this->command->info('creado');
    }
}