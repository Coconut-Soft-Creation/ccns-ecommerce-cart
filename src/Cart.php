<?php

namespace Ccns\CcnsEcommerceCart;

class Cart
{
    protected array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(mixed $request, mixed $item, mixed $quantity): void
    {
        $this->items[] = [
            'item' => $item,
            'quantity' => $quantity,
        ];
    }

    public function removeItem(mixed $request)
    {
    }

    public function clear()
    {
    }
}
