<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;

class Cart implements CartContract
{
    protected $cart;

    public function getItems(): array
    {
        $carts = CartModel::where('user_id', request()->user()->id)->get();
        $cartObjects = new CartCollection($carts);

        return $cartObjects->toArray(request());
    }

    public function addItem(StoreCartRequest $request): CartModel
    {
        return CartModel::updateOrCreate([
            'user_id' => request()->user()->id,
            'product->id' => $request->product['id'],
        ], [
            'product' => $request->product ?? [],
            'options' => $request->option ?? [],
            'price' => $request->price ?? 0,
            'quantity' => $request->quantity ?? 1,
            'total_price' => $request->quantity * $request->price,
        ]);
    }

    public function updateItem(UpdateCartRequest $request, string $cartId): bool
    {
        return CartModel::where('id', $cartId)
            ->where('user_id', request()->user()->id)
            ->update(['quantity' => $request->quantity]);
    }

    public function removeItem(string $cartId): bool
    {
        return CartModel::where('id', $cartId)
            ->where('user_id', request()->user()->id)
            ->delete();
    }
}
