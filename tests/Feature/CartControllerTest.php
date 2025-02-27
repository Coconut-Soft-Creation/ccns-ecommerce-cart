<?php

namespace Tests\Feature;

use Tests\CartTestCase;

class CartControllerTest extends CartTestCase
{
    public function test_user_can_create_cart(): void
    {
        $this->actingAs($this->user)
            ->get(route('cart.index'))
            ->assertSuccessful();

        $this->assertDatabaseHas('carts', ['user_id' => $this->user->id]);
    }

    public function test_user_can_clear_cart(): void
    {
        $this->actingAs($this->user)
            ->delete(route('cart.destroy', ['cart' => $this->cart->id]))
            ->assertRedirect(route('cart.index'));

        $this->assertDatabaseMissing('cart_items', ['cart_id' => $this->cart->id]);

        $this->assertSoftDeleted('carts', ['user_id' => $this->user->id]);
    }
}
