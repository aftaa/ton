<?php

namespace App\MessageHandler;

use App\Entity\Message;
use App\Message\SmsNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SmsNotificationHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function __invoke(SmsNotification $message): void
    {
        $message1 = new Message();
        $message1->setText($message->getMessage());
        $message1->setCreatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($message1);
        $this->entityManager->flush();
    }
}