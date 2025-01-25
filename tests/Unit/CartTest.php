<?php

namespace Ccns\CcnsEcommerceCart\Tests\Unit;

use Ccns\CcnsEcommerceCart\Cart;
use Orchestra\Testbench\PHPUnit\TestCase;

class CartTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [\Ccns\CcnsEcommerceCart\CartServiceProvider::class];
    }

    public function test_add_item()
    {
        $product_id = rand(1, 999999);
        $price = rand(10, 999);
        $quantity = rand(1, 10);

        $product = array_rand([
            'user_id' => 1,
            'product_id' => $product_id,
            'options' => [],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $quantity * $price,
        ]);

        Cart::addItem($product);

        $this->assertArrayHasKey(1, $cart->getItems());
    }

    public function test_remove_item()
    {
        $product_id = rand(1, 999999);
        $price = rand(10, 999);
        $quantity = rand(1, 10);

        $product = array_rand([
            'user_id' => 1,
            'product_id' => $product_id,
            'options' => [],
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $quantity * $price,
        ]);
        Cart::addItem($product);

        $cart = new Cart();
        $cart->addItem($product);
        $cart->removeItem(1);

        $this->assertEmpty($cart->getItems());
    }
}
