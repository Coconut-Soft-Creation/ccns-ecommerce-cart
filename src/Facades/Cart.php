<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getItems()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
