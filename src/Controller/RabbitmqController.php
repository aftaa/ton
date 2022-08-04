<?php

namespace App\Controller;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exchange\AMQPExchangeType;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RabbitmqController extends AbstractController
{
    /**
     * @throws \Exception
     */
    #[Route('/rabbitmq/produce', name: 'rabbitmq_produce')]
    public function produce(): Response
    {
        $connection = $this->getConnection();
        $channel = $connection->channel();
        $channel->queue_declare(
            'test',
            false,
            false,
            false,
            false,
        );

        $message = (object)[
            'name' => 'test',
            'rand' => rand(0, 9),
        ];

        $ampqMessage = new AMQPMessage(serialize($message));

        $channel->basic_publish(
            $ampqMessage,
            '',
            'test',
        );

        $channel->close();
        $connection->close();

        return $this->render('rabbitmq/index.html.twig', [
            'controller_name' => 'RabbitmqController',
        ]);
    }

    #[Route('/rabbitmq/consume', name: 'rabbitmq_consume')]
    public function consume()
    {
        $connection = $this->getConnection();
        $channel = $connection->channel();

        $channel->queue_declare(
            'test',
            false,
            false,
            false,
            false,
        );

        $channel->basic_consume(
            'test',
            '',
            false,
            true,
            false,
            false,
            $this->process(...),
        );

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();
    }

    private function process(string $serializedMessage)
    {
        $message = unserialize($serializedMessage);
        dump($message);
    }

    /**
     * @return AMQPStreamConnection
     */
    private function getConnection(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            'localhost',
            49156,
            'guest',
            'guest',
        );
    }
}
