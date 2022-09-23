<?php

namespace App\Controller;

use App\Interface\RabbitmqManagerInterface;
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
    public function produce(RabbitmqManagerInterface $rabbitmqManager): Response
    {
        $connection = $rabbitmqManager->getConnection();
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
}
