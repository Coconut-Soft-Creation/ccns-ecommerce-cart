<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

interface Cart
{
    /**
     * Get all items in the cart.
     */
    public function getCart(): array;

    /**
     * Add an item to the cart.
     */
    public function addItem(array $request): bool;

    /**
     * Update the quantity of an item in the cart.
     */
    public function editItem(array $request, string $cartItemId): bool;

    /**
     * Remove an item from the cart.
     */
    public function removeItem(string $cartItemId): bool;

    /**
     * Clear all items in the cart.
     */
    public function clearCart(): void;
}
