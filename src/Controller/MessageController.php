<?php

namespace App\Controller;

use App\Message\OtherMessageNotification;
use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route("/message/")]
    public function index(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new SmsNotification($text = 'Look! I created a message!' . rand(0, 10)));
        return $this->render('message/index.html.twig', [
            'message' => $text,
        ]);
    }

    #[Route("/other/message/")]
    public function otherMessage(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new OtherMessageNotification($text = 'other message ' . rand(0, 10)));
        return $this->render('message/index.html.twig', [
            'message' => $text
        ]);
    }
}