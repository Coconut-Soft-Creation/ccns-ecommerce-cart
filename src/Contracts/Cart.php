<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;

interface Cart
{
    /**
     * Get all items in the cart.
     */
    public function getItems(): array;

    /**
     * Add an item to the cart.
     */
    public function addItem(StoreCartRequest $request): CartModel;

    /**
     * Update the quantity of an item in the cart.
     */
    public function updateItem(UpdateCartRequest $request, CartModel $cart): bool;

    /**
     * Remove an item from the cart.
     */
    public function removeItem(CartModel $cart): bool;

    /**
     * Clear all items in the cart.
     */
    public function clear(): bool;
}
