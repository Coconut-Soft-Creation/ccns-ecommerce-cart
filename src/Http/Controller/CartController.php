<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use App\Http\Controllers\Controller;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cart = CartFacade::getItems();

        return view('ccns-ecommerce-cart::cart-index', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request): RedirectResponse
    {
        CartFacade::addItem($request);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, CartModel $cart): RedirectResponse
    {
        CartFacade::updateItem($request, $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartModel $cart): RedirectResponse
    {
        CartFacade::removeItem($cart);

        return redirect()->route('cart.index')->with('success', 'Product deleted!');
    }
}
