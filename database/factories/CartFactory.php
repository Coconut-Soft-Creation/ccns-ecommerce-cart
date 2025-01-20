<?php

namespace database\factories;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomFloat(2, 10, 1000);

        return [
            'id' => $this->faker->uuid,
            'user_id' => $this->faker->randomNumber(),
            'product_id' => $this->faker->randomNumber(),
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $price * $quantity,
        ];
    }
}
