<?php

use Ccns\CcnsEcommerceCart\Http\Controller\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {

    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/', [CartController::class, 'store'])->name('cart.store');
    Route::put('/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

});
