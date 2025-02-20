<?php

namespace Ccns\CcnsEcommerceCart\Managers;

use Ccns\CcnsEcommerceCart\Storages\ArrayCartStorage;
use Ccns\CcnsEcommerceCart\Storages\DatabaseCartStorage;
use Ccns\CcnsEcommerceCart\Storages\FileCartStorage;
use Ccns\CcnsEcommerceCart\Storages\RedisCartStorage;
use Ccns\CcnsEcommerceCart\Storages\SessionCartStorage;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Connection;
use Illuminate\Filesystem\Filesystem;
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
            'database' => new DatabaseCartStorage(app(Connection::class)),
            'redis' => new RedisCartStorage(app(Cache::class)),
            'session' => new SessionCartStorage,
            'file' => new FileCartStorage(app(Filesystem::class)),
            'array' => new ArrayCartStorage,
        };
    }
}
