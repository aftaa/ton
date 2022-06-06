<?php

namespace App\Controller;

use App\Entity\OrderDetail;
use App\Entity\Product;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/product/{product}/', name: 'product')]
    public function product($_locale, Product $product, Request $request, CartManager $cartManager): Response
    {
        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OrderDetail $detail */
            $detail = $form->getData();
            $detail->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addDetail($detail)
                ->setOrderDate(new \DateTime());
            $cartManager->save($cart);

//            $this->redirectToRoute('product', ['product' => $product->getProductID()]);
        }

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
