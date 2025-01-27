<?php

namespace Ccns\CcnsEcommerceCart\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\ServiceProvider;

class InstallCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'ccns-ecommerce-cart:install { --no-migrate : Do not run migrate along with this installation.};}
                                                        { --no-seed : Do not run seed along with this installation.}';

    protected $description = 'Install the CcnsEcommerceCart components and resources';

    public function handle(): void
    {
        $this->publishFiles();

        if ( ! $this->option('no-migrate')) {
            $this->runMigrations();
        }

        if ( ! $this->option('no-seed')) {
            $this->runSeeders();
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
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-factories', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-migrations', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-seeders', '--force' => true]);
        $this->call('vendor:publish', ['--tag' => 'ccns-ecommerce-cart-tests', '--force' => true]);
    }

    protected function runMigrations(): void
    {
        if ($this->confirm('Do you want to run migration?')) {
            $this->call('migrate', ['--force' => true]);
        }

        $this->line('CcnsEcommerceCart migrates successfully.');
    }

    protected function runSeeders(): void
    {
        if ($this->confirm('Do you want to run seeders?')) {
            $this->call('db:seed', ['--class' => 'CartSeeder', '--force' => true]);
        }

        $this->line('CcnsEcommerceCart seeders successfully.');
    }
}
