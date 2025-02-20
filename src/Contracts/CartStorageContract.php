<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;

interface CartStorageContract
{
    public function hasCart(): bool;

    public function makeCart(): CartModel;

    public function getCart(): CartModel;

    public function addItem(array $request): void;

    public function editItem(array $request, string $cartId): void;

    public function removeItem(string $cartId): void;

    public function clearCart(): void;
}
