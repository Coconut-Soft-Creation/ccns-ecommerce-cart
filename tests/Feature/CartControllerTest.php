<?php

namespace Ccns\CcnsEcommerceCart\Tests\Feature;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Tests\TestCase;
use Orchestra\Testbench\TestCase;

class CartControllerTest extends TestCase
{
    public function test_user_can_add_product_to_cart()
    {
        $user = User::factory()->create();

        $price = rand(10, 999);
        $quantity = rand(1, 10);
        $product = array_rand([
            'user_id' => $user->id,
            'product_id' => rand(1, 999999),
            'options' => [],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $quantity * $price,
        ]);

        $this->actingAs($user)
            ->post(route('cart.add', $product['product_id']), ['quantity' => $quantity])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('success', 'Product added to cart!');

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product['product_id'],
            'quantity' => $quantity,
        ]);
    }

    public function test_user_can_update_product_to_cart()
    {
    }
}
