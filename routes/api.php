<?php

use Ccns\CcnsEcommerceCart\Http\Controller\CartController;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Support\Facades\Route;

Route::prefix('api/cart')->group(function () {

    Route::get('/', function (Request $request) {
        return new CartCollection(CartModel::paginate());
    });

    Route::post('/create', function (Request $request) {
        return CartModel::updateOrCreate($request->post());
    });

    Route::post('/update', function (Request $request) {
        return CartModel::where('product_id', $request->product_id)
            ->where('user_id', $request->user_id)
            ->update(['quantity' => $request->quantity]);
    });

    Route::post('/delete', function (Request $request) {
        return CartModel::where('product_id', $request->product_id)
            ->where('user_id', $request->user_id)
            ->delete();
    });

    Route::resource('cart', CartController::class)->except(['create', 'show', 'edit']);
});
