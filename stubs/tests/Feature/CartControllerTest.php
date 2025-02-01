<?php

namespace Tests\Feature;

use Tests\CartTestCase;

class CartControllerTest extends CartTestCase
{
    public function test_user_can_get_cart()
    {
        $this->actingAs($this->user)
            ->get(route('cart.index'))
            ->assertSeeText($this->cart->product['id'])
            ->assertSuccessful();
    }

    public function test_user_can_add_product_to_cart(): void
    {
        $this->actingAs($this->user)
            ->post(route('cart.store', $this->cart->toArray()))
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('success', 'Product added to cart!');

        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
            'product->id' => $this->product['id'],
            'quantity' => $this->quantity,
        ]);
    }

    public function test_user_can_update_product_to_cart(): void
    {
        $quantity = rand(1, 99);

        $this->actingAs($this->user)
            ->put(route('cart.update', $this->cart->id), [
                'quantity' => $quantity,
            ])
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('success', 'Product updated to cart!');

        $this->assertDatabaseHas('carts', [
            'id' => $this->cart->id,
            'user_id' => $this->user->id,
            'quantity' => $quantity,
        ]);
    }

    public function test_user_can_delete_product_from_cart()
    {
        $this->actingAs($this->user)
            ->delete(route('cart.destroy', $this->cart->id))
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('success', 'Product deleted from cart!');

        $this->assertDatabaseMissing('carts', [
            'id' => $this->cart->id,
            'deleted_at' => null,
        ]);
    }
}
