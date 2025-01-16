<?php


use Illuminate\Support\Facades\Route;
use Ccns\CcnsEcommerceCart\Cart;

Route::prefix('cart')->group(function () {
    Route::get('/', function (Cart $cart) {
        return response()->json($cart->getItems());
    });

    Route::post('/add', function (Cart $cart) {
        $cart->addItem(request('item_id'), request('quantity'), request('details', []));
        return response()->json(['status' => 'success']);
    });

    Route::post('/remove', function (Cart $cart) {
        $cart->removeItem(request('item_id'));
        return response()->json(['status' => 'success']);
    });

    Route::post('/clear', function (Cart $cart) {
        $cart->clear();
        return response()->json(['status' => 'success']);
    });
});
