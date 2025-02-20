<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Managers\CartDriverManager;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Http\Request;

class Cart implements CartContract
{
    protected CartStorageContract $cartStorage;

    public function __construct(
        protected CartDriverManager $driverManager
    )
    {
        $this->cartStorage = $driverManager->createDriver(env('CART_DRIVER'));
    }

    public function getCart(array $request): array
    {
        $cart = $this->cartStorage->hasCart()
            ? $this->cartStorage->makeCart()
            : $this->cartStorage->getCart();
    }

    public function addItem(array $request): void
    {
        $this->cartStorage->addItem($request);
    }

    public function editItem(array $request, string $cartItemId): bool
    {
    }

    public function removeItem(string $cartItemId): bool
    {
    }

    public function clearCart(string $cartId): void
    {
        $this->cartStorage->clearCart();
    }
}
