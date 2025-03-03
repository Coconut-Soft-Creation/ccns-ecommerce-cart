<?php

namespace Ccns\CcnsEcommerceCart\Managers;

use Ccns\CcnsEcommerceCart\Contracts\CartStorageContract;
use Ccns\CcnsEcommerceCart\Storages\DatabaseCartStorage;
use Ccns\CcnsEcommerceCart\Storages\RedisCartStorage;
use InvalidArgumentException;

class CartDriverManager
{
    protected static array $supportedDrivers = [
        'database', 'redis'
    ];

    public static function isSupported(string $driver): bool
    {
        return in_array($driver, self::$supportedDrivers, true);
    }

    public static function createDriver(?string $driver = null): CartStorageContract
    {
        $driver = $driver ?? config('cart.driver', 'database');

        if (! self::isSupported($driver)) {
            throw new InvalidArgumentException("Unsupported cart driver: {$driver}");
        }

        return match ($driver) {
            'database' => app(DatabaseCartStorage::class),
            'redis' => app(RedisCartStorage::class),
        };
    }
}
