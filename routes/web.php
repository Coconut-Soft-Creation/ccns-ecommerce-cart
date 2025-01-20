<?php

use Ccns\CcnsEcommerceCart\Http\Controller\CartController;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function () {
    Route::resource('cart', CartController::class)->except(['create', 'show', 'edit']);
});
