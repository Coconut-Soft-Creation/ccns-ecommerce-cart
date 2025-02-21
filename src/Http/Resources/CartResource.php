<?php

namespace Ccns\CcnsEcommerceCart\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['id'],
            'user_id' => $this['user_id'],
            'session_id' => $this['session_id'] ?? '',
            'vat' => $this['vat'] ?? 0,
            'shipping' => $this['shipping'] ?? 0,
            'discount' => $this['discount'] ?? 0,
            'total_price' => $this['total_price'] ?? 0,
            'items' => collect($this['items'])->isEmpty()
                ? CartItemResource::collection($this['items'])->toArray($request)
                : [],
        ];
    }
}
