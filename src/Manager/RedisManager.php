<?php

namespace App\Manager;

use Redis;

class RedisManager
{
    public const HOSTNAME = '127.0.0.1';

    /**
     * @param Redis $redis
     */
    public function __construct(
        private readonly Redis $redis = new Redis(),
    )
    {
        $this->redis->connect(self::HOSTNAME);
    }

    /**
     * @return Redis
     */
    public function getRedis(): Redis
    {
        return $this->redis;
    }
}