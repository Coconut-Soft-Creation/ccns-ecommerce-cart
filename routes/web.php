<?php

use Illuminate\Support\Facades\Route;
use Ccns\CcnsEcommerceCart\Cart;

Route::prefix('cart')->group(function () {

    Route::get('/', function (Cart $cart) {
         $cartItems = $cart->getItems();
        return view('ccns-ecommerce-cart::components.cart', ['items' => $cartItems, 'totalPrice' => 0]);
    })->name('cart');

    Route::post('/add', function (Cart $cart) {
        $itemId = request('item_id');
        $quantity = request('quantity', 1);
        $details = request('details', []);

        $cart->addItem($itemId, $quantity, $details);

        return response()->json(['message' => 'Item added to cart successfully']);
    })->name('cart.add');

    Route::post('/remove', function (Cart $cart) {
        $itemId = request('item_id');

        $cart->removeItem($itemId);

        return response()->json(['message' => 'Item removed from cart successfully']);
    })->name('cart.remove');

    Route::get('/checkout', function (Cart $cart) {
        $cartItems = $cart->getItems();
        $totalPrice = $cart->calculateTotal();

        return view('ecommerce-cart::cart.checkout', compact('cartItems', 'totalPrice'));
    })->name('cart.checkout');

    Route::post('/checkout', function (Cart $cart) {
        $cart->clear();

        return response()->json(['message' => 'Checkout completed successfully']);
    })->name('cart.complete');
});
