<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Resources\CartResource;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class CartController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cartResults = CartFacade::getCart();
        $cart = new CartResource($cartResults);

        return view('ccns-ecommerce-cart::cart-index', compact('cart'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(): RedirectResponse
    {
        CartFacade::clearCart();

        return redirect()->route('cart.index')->with('success', 'Product deleted from cart!');
    }
}
