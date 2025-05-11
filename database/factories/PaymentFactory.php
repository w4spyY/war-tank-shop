<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition()
    {
        $statuses = ['pending', 'completed', 'failed', 'refunded'];
        $methods = ['credit_card', 'paypal', 'bank_transfer'];
        
        return [
            'invoice_id' => Invoice::factory(),
            'amount' => $this->faker->randomFloat(2, 50, 5000),
            'payment_method' => $this->faker->randomElement($methods),
            'transaction_id' => 'TRX-' . strtoupper($this->faker->bothify('??????####')),
            'status' => $this->faker->randomElement($statuses),
            'paid_at' => $this->faker->optional(0.7)->dateTimeBetween('-1 year', 'now'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'paid_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            ];
        });
    }

    public function pending()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
                'paid_at' => null,
            ];
        });
    }

    public function failed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'failed',
                'paid_at' => null,
            ];
        });
    }

    public function creditCard()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method' => 'credit_card',
            ];
        });
    }

    public function paypal()
    {
        return $this->state(function (array $attributes) {
            return [
                'payment_method' => 'paypal',
            ];
        });
    }
}