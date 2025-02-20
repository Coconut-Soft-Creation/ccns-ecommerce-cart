<?php

use Ccns\CcnsEcommerceCart\Http\Controller\CartController;
use Ccns\CcnsEcommerceCart\Http\Controller\CartItemController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {

    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/cart/items', [CartItemController::class, 'store'])->name('cart.items.store');
    Route::put('/cart/items/{cartItem}', [CartItemController::class, 'update'])->name('cart.items.update');
    Route::delete('/cart/items/{cartItem}', [CartItemController::class, 'destroy'])->name('cart.items.destroy');

});
