<?php

namespace App\Factory;

use App\Entity\Customer;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\Size;

class OrderFactory
{
    /**
     * @param Customer|null $customer
     * @return Order
     */
    public function create(?Customer $customer = null): Order
    {
        $order = new Order();
        $order
            ->setOrderStatus(Order::STATUS_CART)
            ->setOrderDate(new \Datetime());
        if (null !== $customer) {
            $order->setCustomer($customer);
        }
        return $order;
    }

    /**
     * @param Product $product
     * @param Size $size
     * @param int $quantity
     * @return OrderDetail
     */
    public function createDetail(Product $product, Size $size, int $quantity = 1): OrderDetail
    {
        $detail = new OrderDetail();
        $detail
            ->setProduct($product)
            ->setSize($size)
            ->setQuantity($quantity);
        return $detail;
    }
}