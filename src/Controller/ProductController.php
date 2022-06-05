<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Shop\CartProduct;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/product/{product}/', name: 'product')]
    public function product($_locale, Product $product): Response
    {
        return $this->render('product/product.html.twig', [
            'product' => $product,
        ]);
    }
}
