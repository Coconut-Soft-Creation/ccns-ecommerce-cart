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
        Redis::command('exists', [$this->cartKey()]) > 0
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
        $cart = $this->getCart();

        return !empty($cart['items'])
            ? collect($cart['items'])
                ->firstWhere('id', $itemId)
                ->toArray()
            : [];
    }

    /**
     * @param array $request
     * @return bool
     */
    public function addItem(array $request): bool
    {
        if ($this->getItem($this->itemKey($request['product_id']))) {
            $this->editItem($request, $this->itemKey($request['product_id']));
        }

        // TODO add new item into array key "items"

        return "OK" === Redis::command('set', [
            $this->cartKey(),
            json_encode($cart, JSON_UNESCAPED_UNICODE)
        ]);
    }

    /**
     * @param array $request
     * @param string $cartItemId
     * @return bool
     */
    public function editItem(array $request, string $cartItemId): bool
    {
        $cart = collect($this->getCart());
        $items = $cart->has('items') ? $cart->get('items') : [];
        $item = $this->getItem($cartItemId);

        $items = !empty($items) && !empty($item)
            ?? collect($items)->search(function ($item) use ($request) {
                $item['quantity'] += $request['quantity'];
                $item['subtotal'] = $item['quantity'] * $item['price'];
            });

        // TODO update an existing item from array key "items"

        return "OK" === Redis::command('set', [
            $this->cartKey(),
            json_encode($cart, JSON_UNESCAPED_UNICODE)
        ]);
    }

    /**
     * @param string $cartItemId
     * @return bool
     */
    public function removeItem(string $cartItemId): bool
    {
    }

    /**
     * @return bool
     */
    public function clearCart(): bool
    {
        return Redis::command('del', [$this->cartKey()]);
    }

    /**
     * @return bool
     */
    public function calculateTotalPrice(): bool
    {
    }

    protected function cartKey(): string
    {
        $cartKey = Auth::check() ? Auth::id() : Session::getId();

        return 'cart_u' . $cartKey;
    }

    protected function itemKey(string $productId): string
    {
        $itemKey = Auth::check() ? Auth::id() : Session::getId();

        return 'item_u' . $itemKey . '_p' . $productId;
    }

    protected function cartStructure(array $item = []): array
    {
        return [
            'user_id' => Auth::check() ? Auth::id() : null,
            'session_id' => Auth::check() ? null : Session::getId(),
            'vat' => 0,
            'shipping' => 0,
            'discount' => 0,
            'total_price' => 0,
            'items' => $this->cartItemStructure($item),
        ];
    }

    protected function cartItemStructure(array $item): array
    {
        return !empty($item) ?
            [
                'id' => $this->itemKey($item['product_id']),
                'cart_id' => $this->cartKey(),
                'product_id' => array_key_exists('product_id', $item) ? $item['product_id'] : null,
                'options' => array_key_exists('options', $item) ? $item['options'] : [],
                'quantity' => array_key_exists('quantity', $item) ? $item['quantity'] : 1,
                'price' => array_key_exists('price', $item) ? $item['price'] : 1,
                'subtotal' => $item['quantity'] * $item['price']
            ]
            : [];
    }
}
