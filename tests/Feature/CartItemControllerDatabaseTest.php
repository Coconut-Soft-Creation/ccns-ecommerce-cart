<?php

namespace Tests\Feature;

use Tests\CartDatabaseTestCase;

class CartItemControllerDatabaseTest extends CartDatabaseTestCase
{
    public function test_user_can_add_product_to_cart(): void
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomNumber(3);
        $subtotal = $quantity * $price;

        $this->actingAs($this->user)
            ->post(route('cart.items.store'), [
                'product_id' => $this->faker->randomDigitNotNull,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,

            ])
            ->assertStatus(302);
    }

    public function test_user_can_edit_product_from_cart(): void
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomNumber(3);
        $subtotal = $quantity * $price;
        $item = $this->cart->items()->create([
            'product_id' => $this->faker->randomDigitNotNull,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ]);

        $this->actingAs($this->user)
            ->put(route('cart.items.update', $item->id), [
                'quantity' => $this->faker->randomDigitNotNull,
            ])
            ->assertStatus(302);
    }

    public function test_user_can_remove_product_from_cart(): void
    {
        $quantity = $this->faker->numberBetween(1, 10);
        $price = $this->faker->randomNumber(3);
        $subtotal = $quantity * $price;
        $item = $this->cart->items()->create([
            'product_id' => $this->faker->randomDigitNotNull,
            'quantity' => $quantity,
            'price' => $price,
            'subtotal' => $subtotal,
        ]);

        $this->actingAs($this->user)
            ->delete(route('cart.items.update', $item->id))
            ->assertStatus(302);
    }
}
