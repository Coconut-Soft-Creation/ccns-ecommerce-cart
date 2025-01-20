<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ccns\CcnsEcommerceCart\Contracts\Cart::class;
    }
}
