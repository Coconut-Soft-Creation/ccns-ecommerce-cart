<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Ccns\CcnsEcommerceCart\Cart as CartService;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Managers\CartDriverManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getItems()
 * @method static addItem(StoreCartRequest $request)
 * @method static updateItem(UpdateCartRequest $request, string $cartId)
 * @method static removeItem(string $cartId)
 */
class Cart extends Facade
{
    protected static array $stores = [];

    protected static ?string $defaultDriver = 'database';

    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }

    public static function store(string $driver = null): CartService
    {
        $driver = $driver ?: (self::$defaultDriver ?: config('cart.storage'));

        if (!CartDriverManager::isSupported($driver)) {
            throw new \InvalidArgumentException("Unsupported cart driver: {$driver}");
        }

        if (!isset(self::$stores[$driver])) {
            self::$stores[$driver] = new CartService(CartDriverManager::createDriver($driver));
        }

        return self::$stores[$driver];
    }
}
