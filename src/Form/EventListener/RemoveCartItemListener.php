<?php

namespace App\Form\EventListener;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RemoveCartItemListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {

    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [FormEvents::POST_SUBMIT => 'postSubmit'];
    }

    public function postSubmit(FormEvent $event): void
    {
        $form = $event->getForm();
        $cart = $form->getData();

        if (!$cart instanceof Order) {
            return;
        }

        foreach ($form->get('details')->all() as $child) {
            if ($child->get('remove')->isClicked()) {
                $cart->removeDetail($child->getData());
                $this->entityManager->persist($cart);
                $this->entityManager->flush();
                break;
            }
        }
    }
}