<?php

namespace Ccns\CcnsEcommerceCart\tests;

use Tests\TestCase;

class CartTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [\Ccns\CcnsEcommerceCart\CartServiceProvider::class];
    }

    public function testBasic()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
