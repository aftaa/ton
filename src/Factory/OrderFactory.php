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
     * @return OrderDetail
     */
    public function createDetail(Product $product, Size $size): OrderDetail
    {
        $detail = new OrderDetail();
        $detail
            ->setProduct($product)
            ->setSize($size)
            ->setQuantity(1);
        return $detail;
    }
}