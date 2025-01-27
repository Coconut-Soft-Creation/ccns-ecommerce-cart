<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartContract;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Support\Facades\Auth;

class Cart implements CartContract
{
    public function getItems(): array
    {
        $carts = CartModel::where('user_id', Auth::user()->id)->get();
        $cartObjects = new CartCollection($carts);

        return $cartItems = $cartObjects->toArray(request());
    }

    public function addItem(StoreCartRequest $request): CartModel
    {
        return CartModel::create([
            'user_id' => $request->user_id,
            'product' => $request->product ?? [],
            'options' => $request->option ?? [],
            'price' => $request->price ?? 0,
            'quantity' => $request->quantity ?? 1,
            'total_price' => $request->quantity * $request->price,
        ]);

        //        return CartModel::updateOrCreate([
        //            'product' => collect($request->product)->toJson(),
        //            'user_id' => 1,
        //        ], [
        //            'user_id' => $request->user_id,
        //            'product' => $request->product ?? [],
        //            'options' => $request->option ?? [],
        //            'price' => $request->price ?? 0,
        //            'quantity' => $request->quantity ?? 1,
        //            'total_price' => $request->quantity * $request->price,
        //        ]);
    }

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
