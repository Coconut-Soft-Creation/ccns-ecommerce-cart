<?php

namespace Ccns\CcnsEcommerceCart\Managers;

use Ccns\CcnsEcommerceCart\Storages\ArrayCartStorage;
use Ccns\CcnsEcommerceCart\Storages\DatabaseCartStorage;
use Ccns\CcnsEcommerceCart\Storages\FileCartStorage;
use Ccns\CcnsEcommerceCart\Storages\RedisCartStorage;
use Ccns\CcnsEcommerceCart\Storages\SessionCartStorage;
use InvalidArgumentException;

class CartDriverManager
{
    protected static array $supportedDrivers = [
        'database', 'redis', 'session', 'file', 'array',
    ];

    public static function isSupported(string $driver): bool
    {
        return in_array($driver, self::$supportedDrivers);
    }

    public static function createDriver(string $driver): ArrayCartStorage|DatabaseCartStorage|FileCartStorage|RedisCartStorage|SessionCartStorage
    {
        if (! self::isSupported($driver)) {
            throw new InvalidArgumentException("Unsupported cart driver: {$driver}");
        }

        return match ($driver) {
            'database' => new DatabaseCartStorage(),
            'redis' => new RedisCartStorage(),
            'session' => new SessionCartStorage(),
            'file' => new FileCartStorage(),
            'array' => new ArrayCartStorage(),
        };
    }
}
