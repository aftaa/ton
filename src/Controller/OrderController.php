<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Form\OrderType;
use App\Manager\CartManager;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Mime\NotificationEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class OrderController extends AbstractController
{
    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    #[Route('/{_locale<en|ru>}/order/', name: 'order')]
    public function index(
        string          $_locale,
        Request         $request,
        CartManager     $cartManager,
        Security        $security,
        MailerInterface $mailer,
        string          $adminEmail,
    ): Response
    {
        /** @var Customer $user */
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('login');
        }

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

            $mailer->send((new NotificationEmail())
                ->subject('New order')
                ->htmlTemplate('emails/new_order.html.twig')
                ->addFrom($adminEmail)
                ->addTo($adminEmail)
                ->context([
                    'order' => $order,
                ])
            );

            return $this->redirectToRoute('cart');
        }

        return $this->render('order/index.html.twig', [
            'order' => $order,
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/my/', name: 'my_orders')]
    public function my(
        Security $security,
    ): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('login');
        }
        $orders = $this->getUser()->getOrders();
        return $this->render('order/my.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/my/{order}', name: 'my_order')]
    public function myOrder()
    {
    }

}
