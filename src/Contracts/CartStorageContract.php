<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Models\CartItem as CartItemModel;

interface CartStorageContract
{
    public function getCart(): array;

    public function getItem(string $productId): array;

    public function addItem(array $request): bool;

    public function editItem(array $request, string $cartItemId): bool;

    public function removeItem(string $cartItemId): bool;

    public function clearCart(): bool;

    public function calculateTotalPrice(string $cartId): bool;
}
