<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    public function test_user_can_add_product_to_cart(): void
    {
        $user = User::factory()->create();
        $faker = Factory::create();
        $product = [
            'id' => $faker->uuid,
            'name' => $faker->name,
            'slug' => $faker->slug,
            'description' => $faker->text,
            'price' => $faker->randomDigit,
        ];
        $quantity = rand(1, 10);
        $total_price = $product['price'] * $quantity;

        $this->actingAs($user)
            ->post(route('cart.store', [
                'user_id' => 1,
                'product' => $product,
                'options' => [],
                'price' => $product['price'],
                'quantity' => $quantity,
                'total_price' => $total_price,
            ]))
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('success', 'Product added to cart!');

        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product' => $product,
            'quantity' => $quantity,
        ]);
    }

    public function test_user_can_update_product_to_cart() {}

    public function test_user_can_delete_product_from_cart() {}
}
