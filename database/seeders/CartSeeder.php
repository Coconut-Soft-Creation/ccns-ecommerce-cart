<?php

namespace Database\Seeders;

use Database\Factories\CartFactory;
use Database\Factories\CartItemFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        CartFactory::new()
            ->count(1)
            ->create()
            ->each(function ($cart) {
                $cart->items()->create([
                    'cart_id' => $cart->id,
                    'product_id' => Str::uuid(),
                    'price' => 1,
                    'quantity' => 1,
                    'subtotal' => 1
                ]);
            });
    }
}
