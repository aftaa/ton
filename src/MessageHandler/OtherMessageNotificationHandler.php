<?php

namespace App\MessageHandler;

use App\Entity\Message;
use App\Entity\OtherMessage;
use App\Message\OtherMessageNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[asMessageHandler]
class OtherMessageNotificationHandler
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function __invoke(OtherMessageNotification $message): void
    {
        $message1 = new OtherMessage();
        $message1->setText($message->getMessage());
        $message1->setCreatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($message1);
        $this->entityManager->flush();
    }
}