<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;

class ArrayCartStorage implements CartStorageContract
{

    public function has(string $userId): bool
    {
        // TODO: Implement has() method.
    }

    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    public function set(string $key, $value): void
    {
        // TODO: Implement set() method.
    }

    public function remove(string $key): void
    {
        // TODO: Implement remove() method.
    }

    public function clear(): void
    {
        // TODO: Implement clear() method.
    }
}
