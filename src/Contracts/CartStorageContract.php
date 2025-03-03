<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

interface CartStorageContract
{
    public function getCart(): array;

    public function getItem(string $itemId): array;

    public function addItem(array $request): bool;

    public function editItem(array $request, string $cartItemId): bool;

    public function removeItem(string $cartItemId): bool;

    public function clearCart(): bool;

    public function calculateTotalPrice(): bool;
}
