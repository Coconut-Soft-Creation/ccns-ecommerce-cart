<?php

namespace Database\Seeders;

use Database\Factories\CartFactory;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        CartFactory::new()->count(10)->create();
    }
}
