<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Tank;
use App\Models\TanksPart;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    public function definition()
    {
        $productType = $this->faker->randomElement(['tank', 'part']);
        $quantity = $this->faker->numberBetween(1, 5);
        
        if ($productType === 'tank') {
            $product = Tank::inRandomOrder()->first() ?? Tank::factory()->create();
            $unitPrice = $product->price;
        } else {
            $product = TanksPart::inRandomOrder()->first() ?? TanksPart::factory()->create();
            $unitPrice = $product->price;
        }

        return [
            'invoice_id' => Invoice::factory(),
            'product_type' => $productType,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'total_price' => $unitPrice * $quantity,
            'name' => $product->name,
            'tax_rate' => 21.00,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function tankItem()
    {
        return $this->state(function (array $attributes) {
            $product = Tank::inRandomOrder()->first() ?? Tank::factory()->create();
            $quantity = $this->faker->numberBetween(1, 5);
            
            return [
                'product_type' => 'tank',
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'total_price' => $product->price * $quantity,
                'name' => $product->name,
            ];
        });
    }

    public function partItem()
    {
        return $this->state(function (array $attributes) {
            $product = TanksPart::inRandomOrder()->first() ?? TanksPart::factory()->create();
            $quantity = $this->faker->numberBetween(1, 5);
            
            return [
                'product_type' => 'part',
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $product->price,
                'total_price' => $product->price * $quantity,
                'name' => $product->name,
            ];
        });
    }
}