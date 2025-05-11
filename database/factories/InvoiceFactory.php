<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition()
    {
        $statuses = ['pending', 'paid', 'cancelled', 'refunded'];
        $paymentMethods = ['credit_card', 'paypal', 'bank_transfer'];
        
        return [
            'user_id' => User::factory(),
            'invoice_number' => 'INV-' . date('Ymd') . '-' . strtoupper($this->faker->bothify('??????')),
            'subtotal' => 0,
            'tax' => 0,
            'total' => 0,
            'status' => $this->faker->randomElement($statuses),
            'payment_method' => $this->faker->randomElement($paymentMethods),
            'billing_name' => $this->faker->name,
            'billing_address' => $this->faker->address,
            'billing_tax_id' => $this->faker->bothify('??#######'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function paid()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'paid',
            ];
        });
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }

    public function cancelled()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'cancelled',
            ];
        });
    }
}