<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Managers\CartDriverManager;
use Illuminate\Support\Facades\Auth;

class Cart implements CartContract
{
    protected CartStorageContract $cartStorage;

    public function __construct(
        protected CartDriverManager $driverManager
    ) {
        $this->cartStorage = $driverManager->createDriver(env('CART_DRIVER'));
    }

    public function getCart(): array
    {
        $cart = $this->cartStorage->hasCart()
            ? $this->cartStorage->getCart()
            : $this->cartStorage->makeCart();

        return $cart->toArray();
    }

    public function addItem(array $request): bool
    {
        $this->cartStorage->addItem($request);
    }

    public function editItem(array $request, string $cartItemId): bool
    {
        $this->cartStorage->editItem($request, $cartItemId);
    }

    public function removeItem(string $cartItemId): bool
    {
        $this->cartStorage->removeItem($cartItemId);
    }

    public function clearCart(): void
    {
        $this->cartStorage->clearCart();
    }
}
