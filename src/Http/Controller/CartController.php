<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use App\Http\Controllers\Controller;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
use Ccns\CcnsEcommerceCart\Http\Resources\CartResource;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Factory|Application|\Illuminate\View\View
    {
        $cartObjects = new CartCollection(CartFacade::getItems());
        $cartItems = $cartObjects->toArray(request());
        $cartData = $cartItems['data'] ?? [];
        $cartSummary = $cartItems['summary'] ?? [];

        return view('ccns-ecommerce-cart::cart-index', compact('cartObjects', 'cartData', 'cartSummary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CartModel $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartModel $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, CartModel $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartModel $cart)
    {
        //
    }
}
