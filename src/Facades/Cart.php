<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getItems()
 * @method static addItem(StoreCartRequest $request)
 * @method static updateItem(UpdateCartRequest $request, CartModel $cart)
 * @method static removeItem(CartModel $cart)
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
