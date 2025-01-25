<?php

namespace Ccns\CcnsEcommerceCart\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    public array $data = [];
    public array $summary = [];

    /**
     * Create a new component instance.
     * @param array $data
     * @param array $summary
     */
    public function __construct(array $data = [], array $summary = [])
    {
        $this->data = $data;
        $this->summary = $summary;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('ccns-ecommerce-cart::components.cart');
    }
}
