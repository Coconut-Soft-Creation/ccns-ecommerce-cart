<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;

interface Cart
{

    /**
     * Get all items in the cart.
     *
     */
    public function getItems(): array;

    /**
     * Add an item to the cart.
     *
     * @param StoreCartRequest $request
     * @return CartModel
     *
     */
    public function addItem(StoreCartRequest $request): CartModel;

    /**
     * Update the quantity of an item in the cart.
     *
     * @param UpdateCartRequest $request
     * @param CartModel $cart
     * @return bool
     *
     */
    public function updateItem(UpdateCartRequest $request, CartModel $cart): bool;

    /**
     * Remove an item from the cart.
     *
     * @param CartModel $cart
     * @return bool
     */
    public function removeItem(CartModel $cart): bool;

    /**
     * Clear all items in the cart.
     *
     * @return bool
     */
    public function clear(): bool;
}
