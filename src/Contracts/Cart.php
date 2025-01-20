<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

interface Cart
{
    /**
     * Add an item to the cart.
     *
     * @param string $itemId
     * @param int $quantity
     * @param array $options
     * @return bool
     */
    public function addItem(string $itemId, int $quantity = 1, array $options = []): bool;

    /**
     * Remove an item from the cart.
     *
     * @param string $itemId
     * @return bool
     */
    public function removeItem(string $itemId): bool;

    /**
     * Update the quantity of an item in the cart.
     *
     * @param string $itemId
     * @param int $quantity
     * @return bool
     */
    public function updateItem(string $itemId, int $quantity): bool;

    /**
     * Get all items in the cart.
     *
     * @return array
     */
    public function getItems(): array;

    /**
     * Clear all items in the cart.
     *
     * @return bool
     */
    public function clear(): bool;
}
