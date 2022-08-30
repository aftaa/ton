<?php

namespace App\Interface;

use PhpAmqpLib\Connection\AMQPStreamConnection;

interface RabbitmqManagerInterface
{
    public function getConnection(): AMQPStreamConnection;
}