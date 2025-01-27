<?php

namespace Ccns\CcnsEcommerceCart\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    public array $cart = [];

    /**
     * Create a new component instance.
     */
    public function __construct(array $cart = [])
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ccns-ecommerce-cart::components.cart');
    }
}
