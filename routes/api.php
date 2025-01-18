<?php

use Illuminate\Support\Facades\Route;
use Ccns\CcnsEcommerceCart\Cart;

Route::prefix('api/cart')->group(function () {
    Route::post('/add', function (Cart $cart) {
        $cart->addItem(request('item_id'), request('quantity', 1), request('details', []));
        return response()->json(['message' => 'Item added to cart successfully']);
    })->name('api.cart.add');

    Route::delete('/remove', function (Cart $cart) {
        $cart->removeItem(request('item_id'));
        return response()->json(['message' => 'Item removed from cart successfully']);
    })->name('api.cart.remove');

    Route::post('/checkout', function (Cart $cart) {
        $cart->clear();
        return response()->json(['message' => 'Checkout completed successfully']);
    })->name('api.cart.complete');
});
