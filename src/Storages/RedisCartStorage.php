<?php

namespace Ccns\CcnsEcommerceCart\Storages;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;

class RedisCartStorage implements CartStorageContract
{

    /**
     * @param string $userId
     * @return bool
     */
    public function has(string $userId): bool
    {
        // TODO: Implement has() method.
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        // TODO: Implement get() method.
    }

    /**
     * @param string $key
     * @param $value
     * @return void
     */
    public function set(string $key, $value): void
    {
        // TODO: Implement set() method.
    }

    /**
     * @param string $key
     * @return void
     */
    public function remove(string $key): void
    {
        // TODO: Implement remove() method.
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        // TODO: Implement clear() method.
    }
}
