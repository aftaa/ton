<?php

namespace App\Manager;

use App\Interface\RabbitmqManagerInterface;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqManager implements RabbitmqManagerInterface
{

    public function getConnection(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            'localhost',
            49156,
            'guest',
            'guest',
        );
    }
}