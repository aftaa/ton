<?php

namespace App\Storage;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    private const CART_KEY_NAME = 'cart_id';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly OrderRepository $cartRepository,
    )
    {
    }

    /**
     * @return Order|null
     */
    public function getCart(): ?Order
    {
        $cart = $this->cartRepository->findOneBy([
            'OrderID' => $this->getCartId(),
            'OrderStatus' => Order::STATUS_CART,
        ]);
        return $cart;
    }

    /**
     * @param Order $cart
     * @return void
     */
    public function setCart(Order $cart): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $cart->getOrderID());
    }

    /**
     * @return int|null
     */
    public function getCartId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }

    /**
     * @return SessionInterface
     */
    public function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }
}