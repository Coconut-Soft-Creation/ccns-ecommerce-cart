<?php

namespace Ccns\CcnsEcommerceCart\View\Components;

use Ccns\CcnsEcommerceCart\Http\Resources\CartResource;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public CartResource $cart) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ccns-ecommerce-cart::components.cart');
    }
}
