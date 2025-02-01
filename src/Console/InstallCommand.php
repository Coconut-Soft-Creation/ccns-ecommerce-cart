<?php

namespace Ccns\CcnsEcommerceCart\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\ServiceProvider;

class InstallCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'ccns-ecommerce-cart:install { --with-files : Publishes files along with this installation. }
                                                        { --with-migrations : Run migrations along with this installation. }
                                                        { --with-seeders : Run seeders along with this installation. }
                                                        { --with-tests : Publishes files tests along with this installation. }';

    protected $description = 'Install the CcnsEcommerceCart components and resources';

    public function handle(): void
    {
        if ($this->option('with-files')) {
            $this->publishFiles();
        }

        if ($this->option('with-migrations')) {
            $this->runMigrations();
        }

        if ($this->option('with-seeders')) {
            $this->runSeeders();
        }

        if ($this->option('with-tests')) {
            $this->publishTests();
        }

        ServiceProvider::addProviderToBootstrapFile('Ccns\CcnsEcommerceCart\CartServiceProvider');

        $this->line('CcnsEcommerceCart component installed successfully.');
    }

    protected function publishFiles(): void
    {
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-assets', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-config', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-translations', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-views', '--force' => true]);

        $this->line('CcnsEcommerceCart publishes files successfully.');
    }

    protected function publishTests(): void
    {
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-tests', '--force' => true]);

        $this->line('CcnsEcommerceCart publishes tests successfully.');
    }

    protected function runMigrations(): void
    {
        if ($this->confirm('Do you want to run migration?')) {
            $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-migrations', '--force' => true]);
            $this->call('migrate', ['--force' => true]);

            $this->line('CcnsEcommerceCart migrates successfully.');
        }
    }

    protected function runSeeders(): void
    {
        if ($this->confirm('Do you want to run seeders?')) {
            $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-factories', '--force' => true]);
            $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-seeders', '--force' => true]);
            $this->call('db:seed', ['--class' => 'CartSeeder', '--force' => true]);

            $this->line('CcnsEcommerceCart seeders successfully.');
        }
    }

}
