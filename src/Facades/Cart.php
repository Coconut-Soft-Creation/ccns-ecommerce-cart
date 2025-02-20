<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Ccns\CcnsEcommerceCart\Cart as CartService;
use Ccns\CcnsEcommerceCart\Managers\CartDriverManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getCart()
 * @method static addItem(array $request)
 * @method static editItem(array $request, string $cartItemId)
 * @method static removeItem(string $cartItemId)
 * @method static clearCart(string $cartId)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
