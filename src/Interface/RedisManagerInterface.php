<?php

namespace App\Interface;

interface RedisManagerInterface
{
    public function getRedis(): \Redis;
}