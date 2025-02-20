<?php

namespace Ccns\CcnsEcommerceCart\Http\Controller;

use Ccns\CcnsEcommerceCart\Facades\Cart as CartFacade;
use Ccns\CcnsEcommerceCart\Http\Resources\CartCollection;
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
        $cartObjects = new CartCollection($cartResults);
        $cart = $cartResults->toArray(request());

        dd($cart);

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
