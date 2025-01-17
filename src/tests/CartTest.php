<?php

namespace Ccns\CcnsEcommerceCart\Tests;

use Ccns\CcnsEcommerceCart\Cart;

use Tests\TestCase;

class CartTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [\Ccns\CcnsEcommerceCart\CartServiceProvider::class];
    }

    public function test_add_item()
    {
        $cart = new Cart();
        $cart->addItem(1, 1, ['name' => 'Test Item']);

        $this->assertArrayHasKey(1, $cart->getItems());
    }

    public function test_remove_item()
    {
        $cart = new Cart();
        $cart->addItem(1, 1, ['name' => 'Test Item']);
        $cart->removeItem(1);

        $this->assertEmpty($cart->getItems());
    }
}
