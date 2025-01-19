<?php

namespace Ccns\CcnsEcommerceCart\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    public array $items = [];
    public int $totalPrice = 0;

    /**
     * Create a new component instance.
     * @param array $items
     * @param float $totalPrice
     */
    public function __construct(array $items = [], float $totalPrice = 0.0)
    {
        $this->items = $items;
        $this->totalPrice = $totalPrice;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ccns-ecommerce-cart::components.cart');
    }
}
