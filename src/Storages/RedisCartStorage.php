<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class RedisCartStorage implements CartStorageContract
{
    /**
     * @return array
     */
    public function getCart(): array
    {
        Redis::command('exists', [$this->cartKey()])
            ? Redis::command('get', [$this->cartKey()])
            : Redis::command('set', [$this->cartKey(), json_encode($this->cartStructure(), JSON_UNESCAPED_UNICODE)]);

        return json_decode(Redis::command('get', [$this->cartKey()]), true);
    }

    /**
     * @param string $itemId
     * @return array
     */
    public function getItem(string $itemId): array
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
        return Redis::command('del', [$this->cartKey()]);
    }

    /**
     * @param string $cartId
     * @return bool
     */
    public function calculateTotalPrice(string $cartId): bool
    {
        // TODO: Implement calculateTotalPrice() method.
    }

    protected function cartKey(): string
    {
        return 'cart_u' . Auth::check() ? Auth::id() : Session::getId();
    }

    protected function cartStructure(): array
    {
        return [
            'user_id' => Auth::check() ? Auth::id() : null,
            'session_id' => Auth::check() ? null : Session::getId(),
            'vat' => 0,
            'shipping' => 0,
            'discount' => 0,
            'total_price' => 0,
            'items' => []
        ];
    }

    protected function cartItemStructure(): array
    {
        return [
            'cart_id' => $this->cartKey(),
            'product_id' => null,
            'options' => [],
            'quantity' => 0,
            'price' => 0,
            'subtotal' => 0,
        ];
    }
}
