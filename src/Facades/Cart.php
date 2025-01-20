<?php

namespace Ccns\CcnsEcommerceCart\Facades;

use Illuminate\Support\Facades\Facade;
use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;

class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CartContract::class;
    }
}
