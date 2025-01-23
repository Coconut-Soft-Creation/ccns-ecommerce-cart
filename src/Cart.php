<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Cart implements CartContract
{
    protected array $items = [];

    public function getItems(): LengthAwarePaginator
    {
        return CartModel::where('user_id', 1)->paginate(5);
    }

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

        CartModel::updateOrCreate(['product_id' => $itemId], $product);

        return true;
    }

    public function updateItem(string $itemId, int $quantity): bool
    {
        return CartModel::where('product_id', $itemId)->where('user_id', 1)->update(['quantity' => $quantity]);
    }

    public function removeItem(string $itemId): bool
    {
        return CartModel::where('product_id', $itemId)->where('user_id', 1)->delete();
    }

    public function clear(): bool
    {
        return CartModel::where('user_id', 1)->delete();
    }
}
