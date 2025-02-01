<?php

namespace Tests;

use App\Models\User;
use Ccns\CcnsEcommerceCart\Models\Cart;
use Database\Factories\CartFactory;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class CartTestCase extends BaseTestCase
{
    use refreshDatabase;

    protected ?User $user;

    protected ?Cart $cart;

    protected object $faker;

    protected array $product = [];

    protected int $quantity = 1;

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->app->environment() !== 'testing') {
            $this->markTestSkipped('environment variable testing skipped');
        }

        $this->faker = Factory::create();

        $this->product = [
            'id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'price' => $this->faker->randomNumber,
        ];

        $this->quantity = $this->faker->randomDigitNotZero();

        $this->user = User::factory()->create();

        $this->cart = CartFactory::new()->create([
            'user_id' => $this->user->id,
            'product' => $this->product,
            'options' => [],
            'price' => $this->product['price'],
            'quantity' => $this->quantity,
            'total_price' => $this->product['price'] * $this->quantity,
        ]);
    }
}
