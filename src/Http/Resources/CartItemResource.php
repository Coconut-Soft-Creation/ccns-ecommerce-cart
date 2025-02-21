<?php

namespace Ccns\CcnsEcommerceCart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'cart_id' => $this['cart_id'],
            'product_id' => $this['product_id'],
            'options' => $this['options'] ?? [],
            'quantity' => $this['quantity'],
            'price' => $this['price'],
            'subtotal' => $this['quantity'] * $this['price']
        ];
    }
}
