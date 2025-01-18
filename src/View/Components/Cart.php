<?php

namespace Ccns\CcnsEcommerceCart\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    public array $items = [];

    public int $total = 0;

    /**
     * Create a new component instance.
     * @param array $items
     * @param float $total
     */
    public function __construct(array $items = [], float $total = 0.0)
    {
        $this->items = $items;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ccns-ecommerce-cart::components.cart');
    }
}
