<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Models\CartItem as CartItemModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class RedisCartStorage implements CartStorageContract
{
    protected string $prefix = 'cart-';

    protected string $key = 'u' . Auth::id;

    /**
     * @return bool
     */
    public function hasCart(): bool
    {
        return Redis::command('exists', [$this->prefix . $this->key]);
    }

    /**
     * @return CartModel
     */
    public function makeCart(): CartModel
    {
    }

    /**
     * @return CartModel
     */
    public function getCart(): CartModel
    {
        // TODO: Implement getCart() method.
    }

    /**
     * @param string $productId
     * @return bool
     */
    public function hasItem(string $productId): bool
    {
        // TODO: Implement hasItem() method.
    }

    /**
     * @param string $productId
     * @return CartItemModel
     */
    public function getItem(string $productId): CartItemModel
    {
        // TODO: Implement getItem() method.
    }

    /**
     * @param array $request
     * @return bool
     */
    public function addItem(array $request): bool
    {
        // TODO: Implement addItem() method.
    }

    /**
     * @param array $request
     * @param string $cartItemId
     * @return bool
     */
    public function editItem(array $request, string $cartItemId): bool
    {
        // TODO: Implement editItem() method.
    }

    /**
     * @param string $cartItemId
     * @return bool
     */
    public function removeItem(string $cartItemId): bool
    {
        // TODO: Implement removeItem() method.
    }

    /**
     * @return bool
     */
    public function clearCart(): bool
    {
        // TODO: Implement clearCart() method.
    }

    /**
     * @param CartModel $cart
     * @return bool
     */
    public function calculateTotalPrice(CartModel $cart): bool
    {
        // TODO: Implement calculateTotalPrice() method.
    }
}
