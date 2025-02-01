<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Requests\StoreCartRequest;
use Ccns\CcnsEcommerceCart\Http\Requests\UpdateCartRequest;
use Ccns\CcnsEcommerceCart\Models\Cart as CartModel;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class CartController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('viewAny', CartModel::class);

        $cart = CartFacade::getItems($request);

        return view('ccns-ecommerce-cart::cart-index', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request): RedirectResponse
    {
        $this->authorize('create', CartModel::class);

        CartFacade::addItem($request);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, string $cartId): RedirectResponse
    {
        $this->authorize('update', CartModel::findOrFail($cartId));

        CartFacade::updateItem($request, $cartId);

        return redirect()->route('cart.index')->with('success', 'Product updated to cart!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cartId): RedirectResponse
    {
        $this->authorize('delete', CartModel::findOrFail($cartId));

        CartFacade::removeItem($cartId);

        return redirect()->route('cart.index')->with('success', 'Product deleted from cart!');
    }
}
