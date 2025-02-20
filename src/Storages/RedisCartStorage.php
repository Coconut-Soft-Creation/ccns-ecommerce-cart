<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;

class RedisCartStorage implements CartStorageContract
{
    public function has(string $userId): bool
    {
        // TODO: Implement has() method.
    }

    /**
     * @return mixed
     */
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
