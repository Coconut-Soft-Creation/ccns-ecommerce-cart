<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;

class DatabaseCartStorage implements CartStorageContract
{
    public function hasCart(): bool
    {
        return CartModel::where(['user_id' => request()->user()->id])
            ->orWhere(['session_id' => request()->session()->getId()])
            ->exists();
    }

    public function makeCart(): CartModel
    {
        return auth()->check()
            ? CartModel::create(['user_id' => request()->user()->id])
            : CartModel::create(['session_id' => request()->session()->getId()]);
    }

    public function getCart(): CartModel
    {
        $cartModel = CartModel::with('items');

        return auth()->check()
            ? $cartModel->where(['user_id' => request()->user()->id])->first()
            : $cartModel->where(['session_id' => request()->session()->getId()])->first();
    }

    /**
     * @param array $request
     * @return void
     */
    public function addItem(array $request): void
    {
        $cart = $this->getCart();

        $cart->items()->updateOrCreate(
            ['product_id' => $request['product_id']],
            []
        );
    }

    /**
     * @param array $request
     * @param string $cartId
     * @return void
     */
    public function editItem(array $request, string $cartId): void
    {
    }

    /**
     * @param string $cartId
     * @return bool|null
     */
    public function removeItem(string $cartId): ?bool
    {
    }

    /**
     * @return void
     */
    public function clearCart(): void
    {
    }
}
