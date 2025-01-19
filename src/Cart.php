<?php

namespace Ccns\CcnsEcommerceCart;

use Ccns\CcnsEcommerceCart\Contracts\Cart as CartInterface;

class Cart implements CartInterface
{
    protected array $items = [];

    public function addItem(string $itemId, int $quantity = 1, array $options = []): bool
    {
        $this->items[$itemId] = [
            'quantity' => $quantity,
            'options' => $options,
        ];
        return true;
    }

    public function removeItem(string $itemId): bool
    {
        unset($this->items[$itemId]);
        return true;
    }

    public function updateItem(string $itemId, int $quantity): bool
    {
        if (isset($this->items[$itemId])) {
            $this->items[$itemId]['quantity'] = $quantity;
            return true;
        }
        return false;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function calculateTotal(): float
    {
        $total = 0;
        foreach ($this->items as $item) {
            $price = $item['options']['price'] ?? 0;
            $total += $price * $item['quantity'];
        }
        return $total;
    }

    public function clear(): bool
    {
        $this->items = [];
        return true;
    }
}
