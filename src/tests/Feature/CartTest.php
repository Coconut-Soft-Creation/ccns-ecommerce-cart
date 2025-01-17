<?php

namespace Ccns\CcnsEcommerceCart\tests\Feature;

use Tests\TestCase;

class CartTest extends TestCase
{
    public function test_add_item_route()
    {
        $response = $this->postJson('/cart/add', [
            'item_id' => 1,
            'quantity' => 2,
            'details' => ['name' => 'Test Product'],
        ]);

        $response->assertStatus(200);
    }
}
