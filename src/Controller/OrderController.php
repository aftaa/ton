<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Form\OrderType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class OrderController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/order', name: 'order')]
    public function index(string $_locale, Request $request, CartManager $cartManager, Security $security): Response
    {
        /** @var Customer $user */
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        dump($user);

        $order = $cartManager->getCurrentCart();

        if (!$order->getTotalPrice()) {
            $order
                ->setTotalPrice($order->getTotal())
                ->setTotalQuantity($order->getQuantity())
                ->setCustomer($user)
                ->setShipCountry($user->getCountry())
                ->setShipCity($user->getCity())
                ->setShipPostalcode($user->getPostalcode())
                ->setShipAddress($user->getAddress())
                ->setShipMetro($user->getMetro());
            dump($order);
            foreach ($order->getDetails() as $detail) {
                $detail
                    ->setProductDesc($detail->getProduct()->getNameByLocale($_locale))
                    ->setProductPrice($detail->getProduct()->getPrice())
                    ->setProductSize($detail->getSize()->getSizeID());
            }
            $cartManager->save($order);
        }

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Order $order */
            $order = $form->getData();
            $order->setOrderStatus(0);
            $cartManager->save($order);
            return $this->redirectToRoute('cart');
        }

        return $this->render('order/index.html.twig', [
            'order' => $order,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
