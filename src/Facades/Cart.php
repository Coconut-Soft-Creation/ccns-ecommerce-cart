<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getItems()
 * @method static addItem(StoreCartRequest $request)
 * @method static updateItem(UpdateCartRequest $request, string $cartId)
 * @method static removeItem(string $cartId)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
