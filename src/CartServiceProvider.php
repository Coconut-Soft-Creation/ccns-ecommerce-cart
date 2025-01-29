<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Cart as CartService;
use Ccns\CcnsEcommerceCart\Console\InstallCommand;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Policies\CartPolicy;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerBindings();
        $this->registerConfig();
        $this->registerBladeDirectives();
        $this->configureCommands();
    }

    public function boot(): void
    {
        $this->loadComponents();
        $this->publishComponents();

        //        Gate::policy(CartModel::class, CartPolicy::class);
    }

    protected function registerBindings(): void
    {
        $this->app->singleton('cart', function ($app) {
            return new CartService;
        });
    }

    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ccns-ecommerce-cart.php', 'cart');
    }

    protected function registerBladeDirectives(): void
    {
        Blade::componentNamespace('Ccns\\CcnsEcommerceCart\\View\\Components', 'ccns-ecommerce-cart');
    }

    protected function loadComponents(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/channel.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'ccns-ecommerce-cart');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ccns-ecommerce-cart');
    }

    protected function publishComponents(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/ccns-ecommerce-cart.php' => config_path('ccns-ecommerce-cart.php'),
        ], 'ccns-ecommerce-cart-config');

        $vendorPath = 'vendor/ccns-ecommerce-cart';

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/'.$vendorPath),
        ], 'ccns-ecommerce-cart-views');

        $this->publishes([
            __DIR__.'/../resources/public' => public_path($vendorPath),
        ], 'ccns-ecommerce-cart-assets');

        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], 'ccns-ecommerce-cart-factories');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations'),
        ], 'ccns-ecommerce-cart-migrations');

        $this->publishes([
            __DIR__.'/../database/seeders' => database_path('seeders'),
        ], 'ccns-ecommerce-cart-seeders');

        $this->publishes([
            __DIR__.'/../lang' => lang_path($vendorPath),
        ], 'ccns-ecommerce-cart-translations');

        $this->publishes([
            __DIR__.'/../routes/web.php' => base_path('routes/'.$vendorPath.'/web.php'),
            __DIR__.'/../routes/api.php' => base_path('routes/'.$vendorPath.'/api.php'),
            __DIR__.'/../routes/channel.php' => base_path('routes/'.$vendorPath.'/channel.php'),
        ], 'ccns-ecommerce-cart-routes');

        $this->publishes([
            __DIR__.'/../tests/Unit' => base_path('tests/Unit'),
            __DIR__.'/../tests/Feature' => base_path('tests/Feature'),
        ], 'ccns-ecommerce-cart-tests');
    }

    protected function configureCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(InstallCommand::class);
    }
}
