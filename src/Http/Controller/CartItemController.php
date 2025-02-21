<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CartItemController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request): RedirectResponse
    {
        dd($request);
        CartFacade::addItem($request->toArray());

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $cartItemId): RedirectResponse
    {
        CartFacade::editItem($request->toArray(), $cartItemId);

        return redirect()->route('cart.index')->with('success', 'Product updated to cart!');
    }

    public function destroy(string $cartItemId): RedirectResponse
    {
        CartFacade::removeItem($cartItemId);

        return redirect()->route('cart.index')->with('success', 'Product deleted from cart!');
    }
}
