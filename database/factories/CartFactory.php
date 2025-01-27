<?php

namespace Database\Factories;

use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomDigit();

        return [
            'id' => $this->faker->uuid,
            'user_id' => $this->faker->randomDigitNotNull(),
            'product' => [],
            'options' => [],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $price * $quantity,
        ];
    }
}
