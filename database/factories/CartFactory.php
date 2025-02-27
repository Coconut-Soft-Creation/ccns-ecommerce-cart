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
        return [
            'user_id' => User::factory(),
            'session_id' => null,
            'vat' => 0,
            'shipping' => 0,
            'discount' => 0,
            'total_price' => 0,
        ];
    }
}
