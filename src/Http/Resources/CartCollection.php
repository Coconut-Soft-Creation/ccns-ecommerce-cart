<?php

namespace Ccns\CcnsEcommerceCart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Ccns\CcnsEcommerceCart\Models\Cart */
class CartCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $subtotal = $this->collection->sum('total_price');
        $discount = 0;
        $shipping = 0;

        return [
            'data' => CartResource::collection($this->collection),
            'summary' => [
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $subtotal - $discount,
            ],
        ];
    }
}
