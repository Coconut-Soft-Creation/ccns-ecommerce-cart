<?php

namespace Ccns\CcnsEcommerceCart;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Ccns\CcnsEcommerceCart\Cart as CartService;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Blade::componentNamespace('Ccns\\CcnsEcommerceCart\\View\\Components', 'ccns-ecommerce-cart');

        $this->mergeConfigFrom(__DIR__ . '/../config/ccns-ecommerce-cart.php', 'cart');

        $this->app->singleton('cart', function ($app) {
            return new CartService();
        });
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/channel.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'ccns-ecommerce-cart');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ccns-ecommerce-cart');

        $this->publishes([
            __DIR__ . '/../config/ccns-ecommerce-cart.php' => config_path('ccns-ecommerce-cart.php'),
        ], 'ccns-ecommerce-cart-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/ccns-ecommerce-cart'),
        ], 'ccns-ecommerce-cart-views');

        $this->publishes([
            __DIR__ . '/../resources/public' => public_path('vendor/ccns-ecommerce-cart'),
        ], 'ccns-ecommerce-cart-assets');

        $this->publishes([
            __DIR__ . '/../database/factories/' => database_path('factories'),
        ], 'ccns-ecommerce-cart-factories');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations'),
        ], 'ccns-ecommerce-cart-migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders/' => database_path('seeders'),
        ], 'ccns-ecommerce-cart-seeders');

        $this->publishes([
            __DIR__ . '/../lang' => lang_path('vendor/ccns-ecommerce-cart'),
        ], 'ccns-ecommerce-cart-translations');

        $this->publishes([
            __DIR__ . '/../routes/web.php' => base_path('routes/vendor/ccns-ecommerce-cart/web.php'),
            __DIR__ . '/../routes/api.php' => base_path('routes/vendor/ccns-ecommerce-cart/api.php'),
            __DIR__ . '/../routes/channel.php' => base_path('routes/vendor/ccns-ecommerce-cart/channel.php'),
        ], 'ccns-ecommerce-cart-routes');
    }
}
