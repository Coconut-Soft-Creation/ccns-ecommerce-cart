<?php

namespace Ccns\CcnsEcommerceCart;

use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ccns-ecommerce-cart.php', 'cart');

        $this->app->singleton('cart', function () {
            return new Cart();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/ccns-ecommerce-cart.php' => config_path('ccns-ecommerce-cart.php'),
        ], 'config');
    }
}
