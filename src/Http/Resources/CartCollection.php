<?php

namespace Ccns\CcnsEcommerceCart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Ccns\CcnsEcommerceCart\Models\Cart */
class CartCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $subtotal = $this->collection->sum('total_price');
        $discount = 20;
        $shipping = 30;

        return [
            'data' => CartResource::collection($this->collection),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'shipping' => $shipping,
            'total' => $subtotal - $discount + $shipping,
        ];
    }
}
