<?php

use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Support\Facades\Route;

Route::prefix('api/cart')->group(function () {

    Route::get('/', function () {
        return CartFacade::getItems();
    });

    Route::post('/create', function (StoreCartRequest $request) {
        return CartFacade::addItem($request);
    });

    Route::post('/update', function (UpdateCartRequest $request, CartModel $cartModel) {
        return CartFacade::updateItem($request, $cartModel);
    });

    Route::post('/delete', function (CartModel $cartModel) {
        return CartFacade::removeItem($cartModel);
    });

});
