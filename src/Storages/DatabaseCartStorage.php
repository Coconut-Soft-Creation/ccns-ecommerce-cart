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
    public function getCart(): array
    {
        $cartModel = CartModel::with('items');

        $cart = Auth::check()
            ? $cartModel->firstWhere(['user_id' => Auth::id()])
            : $cartModel->firstWhere(['session_id' => Session::id()]);

        return ($cart) ? $cart->toArray() : [];
    }

    public function getItem(string $itemId): array
    {
        $item = CartItemModel::find($itemId);

        return ($item) ? $item->toArray() : [];
    }

    public function addItem(array $request): bool
    {
        $cart = $this->getCart();
        $item = collect($cart['items'])->firstWhere('product_id', $request['product_id']);

        DB::beginTransaction();
        if (is_null($item)) {
            $cartItemModel = new CartItemModel;
            $cartItemModel->fill($request);
            $cartItemModel['cart_id'] = $cart['id'];
            $cartItemModel['subtotal'] = $request['quantity'] * $request['price'];
        } else {
            $cartItemModel = CartItemModel::find($item['id']);
            $quantity = $item['quantity'] + $request['quantity'];
            $subtotal = $item['price'] * $quantity;
            $cartItemModel->quantity = $quantity;
            $cartItemModel->subtotal = $subtotal;
        }
        if (! $cartItemModel->save()) {
            DB::rollBack();

            return false;
        }

        if (! $this->calculateTotalPrice($cart['id'])) {
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
        $itemModel = CartItemModel::find($cartItemId);
        $itemModel->quantity = $request['quantity'];
        $itemModel->subtotal = $itemModel['price'] * $request['quantity'];
        if (! $itemModel->save()) {
            DB::rollBack();

            return false;
        }

        if (! $this->calculateTotalPrice($cart['id'])) {
            DB::rollBack();

            return false;
        }
        DB::commit();

        return true;
    }

    public function removeItem(string $cartItemId): bool
    {
        $cart = $this->getCart();

        DB::beginTransaction();
        CartItemModel::destroy($cartItemId);

        if (! $this->calculateTotalPrice($cart['id'])) {
            DB::rollBack();

            return false;
        }
        DB::commit();

        return true;
    }

    public function clearCart(): bool
    {
        $cart = $this->getCart();

        return CartModel::destroy($cart['id'])
            && CartItemModel::destroy(collect($cart['items'])->pluck('id'));
    }

    public function calculateTotalPrice(string $cartId): bool
    {
        return ($cart = CartModel::find($cartId))
            && $cart->update(['total_price' => $cart->items()->sum('subtotal')]);
    }
}
