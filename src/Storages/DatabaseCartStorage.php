<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Models\CartItem as CartItemModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DatabaseCartStorage implements CartStorageContract
{
    public function hasCart(): bool
    {
        return Auth::check()
            ? CartModel::where(['user_id' => Auth::id()])->exists()
            : CartModel::where(['session_id' => Session::getid()])->exists();
    }

    public function makeCart(): CartModel
    {
        return Auth::check()
            ? CartModel::create(['user_id' => Auth::id()])
            : CartModel::create(['session_id' => Session::getid()]);
    }

    public function getCart(): CartModel
    {
        $cartModel = CartModel::with('items');

        return Auth::check()
            ? $cartModel->where(['user_id' => Auth::id()])->first()
            : $cartModel->where(['session_id' => Session::id()])->first();
    }

    public function hasItem(string $itemId): bool
    {
        $cart = $this->getCart();

        return $cart->items->where('id', $itemId)->exists();
    }

    public function getItem(string $itemId): CartItemModel
    {
        $cart = $this->getCart();

        return $cart->items->where('id', $itemId)->first();
    }

    public function addItem(array $request): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();

        if (!$cart->items()->updateOrInsert(
            ['product_id' => $request['product_id']],
            [
                'options' => $request['options'],
                'quantity' => DB::raw('quantity + ' . $request['quantity']),
                'price' => $request['price'],
            ]
        )) {
            DB::rollBack();
        }

        if (!$this->calculateTotalPrice($cart)) {
            DB::rollBack();
        }

        DB::commit();

        return true;
    }

    public function editItem(array $request, string $cartItemId): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();

        if (!$cart->items()->where('id', $cartItemId)
            ->update([
                'options' => $request['options'],
                'quantity' => DB::raw('quantity + ' . $request['quantity']),
            ])) {
            DB::rollBack();
        }

        if (!$this->calculateTotalPrice($cart)) {
            DB::rollBack();
        }

        DB::commit();

        return true;
    }

    public function removeItem(string $cartItemId): bool
    {
        $cart = $this->getCart();

        return $cart->items()->where('id', $cartItemId)->delete();
    }

    public function clearCart(): bool
    {
        $cart = $this->getCart();

        return $cart->items()->delete();
    }

    public function calculateTotalPrice(CartModel $cartModel): bool
    {
        return $cartModel->update(['total_price' => $cartModel->items()->sum(DB::raw('quantity * price'))]);
    }
}
