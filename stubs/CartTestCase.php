<?php

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class CartTestCase extends BaseTestCase
{
    use RefreshDatabase, withFaker;

    protected ?User $user;

    protected ?Cart $cart;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->app->environment() !== 'testing') {
            $this->markTestSkipped('environment variable testing skipped');
        }

        $this->user = User::inRandomOrder()->first() ?? User::factory()->create();

        $this->cart = Cart::firstOrCreate(
            ['user_id' => $this->user->id],
            [
                'user_id' => $this->user->id,
                'session_id' => null,
                'total_price' => 0,
            ]);
    }
}
