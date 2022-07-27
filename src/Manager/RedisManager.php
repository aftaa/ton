<?php

namespace App\Manager;

use App\Interface\RedisManagerInterface;
use Redis;

class RedisManager implements RedisManagerInterface
{
    public const HOSTNAME = '127.0.0.1';
    private static ?\Redis $redis = null;

    /**
     *
     */
    public function __construct()
    {
        if (!self::$redis instanceof Redis) {
            self::$redis = new Redis();
            self::$redis->connect(self::HOSTNAME);
        }
    }

    /**
     * @return Redis
     */
    public function getRedis(): Redis
    {
        return self::$redis;
    }
}