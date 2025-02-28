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
            ? $cartModel->where(['user_id' => Auth::id()])->first()
            : $cartModel->where(['session_id' => Session::id()])->first();

        return $cart->toArray();
    }

    public function getItem(string $productId): array
    {
        $cart = $this->getCart();
        $item = CartModel::make($cart)->items()
            ->firstWhere('product_id', $productId);

        return ($item) ? $item->toArray() : [];
    }

    public function addItem(array $request): bool
    {
        $cart = $this->getCart();
        $item = $this->getItem($request['product_id']);

        DB::beginTransaction();
        if (collect($item)->isEmpty()) {
            $cartItemModel = new CartItemModel();
            $cartItemModel->fill($request);
            $cartItemModel['cart_id'] = $cart['id'];
            $cartItemModel['subtotal'] = $request['quantity'] * $request['price'];
            if (!$cartItemModel->save()) {
                DB::rollBack();
                return false;
            }
        } else {
            $cartItemModel = CartItemModel::make($item);
            $quantity = $item['quantity'] + $request['quantity'];
            $subtotal = $item['price'] * $quantity;
            $cartItemModel->quantity = $quantity;
            $cartItemModel->subtotal = $subtotal;
            if (!$cartItemModel->save()) {
                DB::rollBack();
                return false;
            }
        }

        if (!$this->calculateTotalPrice($cart['id'])) {
            DB::rollBack();
            return false;
        }
        DB::commit();

        return true;
    }

    public function editItem(array $request, string $cartItemId): bool
    {
        $cart = $this->getCart();
        $item = $this->getItem($cartItemId);

        DB::beginTransaction();
        if (collect($item)->isNotEmpty()) {
            $cartItemModel = CartItemModel::make($item);
            $subtotal = $item['price'] * $request['quantity'];
            $cartItemModel->quantity = $request['quantity'];
            $cartItemModel->subototal = $subtotal;
            if (!$cartItemModel->save()) {
                DB::rollBack();
                return false;
            }
        }

        if (!$this->calculateTotalPrice($cart['id'])) {
            DB::rollBack();
            return false;
        }
        DB::commit();

        return true;
    }

    public function removeItem(string $cartItemId): bool
    {
        $cart = $this->getCart();
        $item = $this->getItem($cartItemId);

        DB::beginTransaction();
        if (collect($item)->isNotEmpty()) {
            $cartItemModel = CartItemModel::make($item);
            if (!$cartItemModel->delete()) {
                DB::rollBack();
                return false;
            }
        }

        if (!$this->calculateTotalPrice($cart['id'])) {
            DB::rollBack();
            return false;
        }
        DB::commit();

        return true;
    }

    public function clearCart(): bool
    {
        $cart = $this->getCart();

        return collect($cart['items'])->isNotEmpty()
            ?? (CartModel::make($cart)->items()->delete()->delete());
    }

    public function calculateTotalPrice(string $cartId): bool
    {
        return ($cart = CartModel::find($cartId))
            && $cart->update(['total_price' => $cart->items()->sum('subtotal')]);
    }
}
