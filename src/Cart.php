<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class Cart implements CartContract
{
    /**
     * @return array
     */
    public function getItems(): array
    {
        $carts = CartModel::where('user_id', Auth::user()->id)->get();
        $cartObjects = new CartCollection($carts);

        return $cartItems = $cartObjects->toArray(request());
    }

    /**
     * @param StoreCartRequest $request
     * @return CartModel
     */
    public function addItem(StoreCartRequest $request): CartModel
    {
        $product = array_rand([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id ?? null,
            'options' => $request->option ?? [],
            'price' => $request->price ?? 0,
            'quantity' => $request->quantity ?? 1,
            'total_price' => $request->quantity * $request->price
        ]);

        return CartModel::updateOrCreate([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
        ], $product);
    }

    /**
     * @param UpdateCartRequest $request
     * @param CartModel $cart
     * @return bool
     */
    public function updateItem(UpdateCartRequest $request, CartModel $cart): bool
    {
        return CartModel::where('id', $cart->id)
            ->where('user_id', Auth::user()->id)
            ->update(['quantity' => $request->quantity]);
    }

    public function removeItem(CartModel $cart): bool
    {
        return CartModel::where('id', $cart->id)
            ->where('user_id', Auth::user()->id)
            ->delete();
    }

    public function clear(): bool
    {
        return CartModel::where('user_id', Auth::user()->id)->delete();
    }
}
