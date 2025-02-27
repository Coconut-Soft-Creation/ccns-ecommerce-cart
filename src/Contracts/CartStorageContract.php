<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Models\CartItem as CartItemModel;

interface CartStorageContract
{
    public function hasCart(): bool;

    public function makeCart(): CartModel;

    public function getCart(): CartModel;

    public function hasItem(string $productId): bool;

    public function getItem(string $productId): CartItemModel;

    public function addItem(array $request): bool;

    public function editItem(array $request, string $cartItemId): bool;

    public function removeItem(string $cartItemId): bool;

    public function clearCart(): bool;

    public function calculateTotalPrice(CartModel $cart): bool;
}
