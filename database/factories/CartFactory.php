<?php

namespace Database\Factories;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        $quantity = $this->faker->randomDigitNotZero();
        $price = $this->faker->randomNumber();

        return [
            'user_id' => User::factory(),
            'product' => [
                'id' => $this->faker->uuid,
                'name' => $this->faker->userName,
                'slug' => $this->faker->slug,
                'description' => 'description',
                'price' => $price,
            ],
            'options' => [],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $price * $quantity,
        ];
    }
}
