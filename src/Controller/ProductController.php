<?php

namespace App\Controller;

use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Entity\Shop\CartProduct;
use App\Form\OrderDetailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/product/{product}/', name: 'product')]
    public function product($_locale, Product $product): Response
    {
        $orderDetail = new OrderDetail();
        $form = $this->createForm(OrderDetailType::class, $orderDetail);
        return $this->render('product/product.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
