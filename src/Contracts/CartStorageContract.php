<?php

namespace Ccns\CcnsEcommerceCart\Contracts;

interface CartStorageContract
{
    public function has(string $key): bool;

    public function get(string $key);

    public function set(string $key, $value): void;

    public function remove(string $key): void;

    public function clear(): void;
}
