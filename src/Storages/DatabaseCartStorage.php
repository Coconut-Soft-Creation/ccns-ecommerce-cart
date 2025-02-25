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

    public function hasItem(string $productId): bool
    {
        $cart = $this->getCart();

        return $cart->items()->where('product_id', $productId)->exists();
    }

    public function getItem(string $productId): CartItemModel
    {
        $cart = $this->getCart();

        return $cart->items()->firstWhere('product_id', $productId);
    }

    public function addItem(array $request): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();

        if ($this->hasItem($request['product_id'])) {
            $item = $this->getItem($request['product_id']);
            $quantity = $item['quantity'] + $request['quantity'];
            $subtotal = $item['price'] * $quantity;
            $item->update([
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        } else {
            $cart->items()
                ->create([
                    'cart_id' => $cart->id,
                    'product_id' => $request['product_id'],
                    'options' => $request['options'] ?? [],
                    'quantity' => $request['quantity'],
                    'price' => $request['price'],
                    'subtotal' => $request['quantity'] * $request['price'],
                ]);
        }

        if (! $this->calculateTotalPrice($cart)) {
            DB::rollBack();

            return false;
        }

        DB::commit();

        return true;
    }

    public function editItem(array $request, string $cartItemId): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();

        if ($item = $cart->items()->find($cartItemId)) {
            $quantity = $item['quantity'] + $request['quantity'];
            $subtotal = $item['price'] * $quantity;
            $item->update([
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        } else {
            return false;
        }

        if (! $this->calculateTotalPrice($cart)) {
            DB::rollBack();
        }

        DB::commit();

        return true;
    }

    public function removeItem(string $cartItemId): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();

        if ($item = $cart->items()->find($cartItemId)) {
            $item->delete();
        } else {
            return false;
        }

        if (! $this->calculateTotalPrice($cart)) {
            DB::rollBack();

            return false;
        }

        DB::commit();

        return true;
    }

    public function clearCart(): bool
    {
        $cart = $this->getCart();

        if ($cart->items()->count()) {
            $cart->items()->delete();
        }

        if ($cart->delete()) {
            return true;
        }

        return false;
    }

    public function calculateTotalPrice(CartModel $cart): bool
    {
        return $cart->update(['total_price' => $cart->items()->sum('subtotal')]);
    }
}
