<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartInterface;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;

class Cart implements CartInterface
{
    protected array $items = [];

    public function addItem(string $itemId, int $quantity = 1, array $options = []): bool
    {
        $itemId = rand(1, 999999);
        $price = rand(10, 999);

        $product = array_rand([
            'user_id' => 1,
            'product_id' => $itemId,
            'options' => $options,
            'price' => $price,
            'quantity' => $quantity,
            'total_price' => $quantity * $price,
        ]);

        CartModel::updateOrCreate(['id' => $itemId], $product);

        return true;
    }

    public function removeItem(string $itemId): bool
    {
        return CartModel::where('id', $itemId)->where('user_id', 1)->delete();
    }

    public function updateItem(string $itemId, int $quantity): bool
    {
        return CartModel::where('id', $itemId)->where('user_id', 1)->update(['quantity' => $quantity]);
    }

    public function getItems(): array
    {
        return CartModel::with('product')->where('user_id', Auth::id())->get()->toArray();
    }

    public function clear(): bool
    {
        $this->items = [];
        return true;
    }
}
