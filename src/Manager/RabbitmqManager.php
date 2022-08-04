<?php

namespace App\Manager;

use App\Interface\RabbitmqManagerInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqManager implements RabbitmqManagerInterface
{
    /**
     * @param AMQPStreamConnection $connection
     */
    public function __construct(
        private readonly AMQPStreamConnection $connection =
        new AMQPStreamConnection(
            'localhost',
            49156,
            'guest',
            'guest',
        )
    )
    {
    }

    /**
     * @return AMQPStreamConnection
     */
    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }
}