<?php

namespace Database\Factories;

use Ccns\CcnsEcommerceCart\Models\Cart;
use Ccns\CcnsEcommerceCart\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'cart_id' => Cart::factory(),
            'product_id' => $this->faker->uuid(),
            'options' => [],
            'quantity' => 1,
            'price' => 1,
            'subtotal' => 1,
        ];
    }
}
