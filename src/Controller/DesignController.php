<?php

namespace App\Controller;

use App\Repository\DesignRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DesignController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/collection/', name: 'collection')]
    public function index(string $_locale, Request $request, DesignRepository $designRepository): Response
    {
        $collection = $designRepository->findCollection(
            $_locale,
            $request->query->getint('typeId', 0),
            $request->query->getInt('labelId', 0),
        );

        $addUri = [];
        if ($request->query->has('typeId')) {
            $addUri['typeId'] = $request->query->getInt('typeId');
        }

        if ($request->query->has('labelId')) {
            $addUri['labelId'] = $request->query->getInt('labelId');
        }

        foreach ($collection as &$item) {
            $item['uri'] = $addUri + ['designId' => $item['id']];
        }

        return $this->render('collection/index.html.twig', [
            'collection' => $collection,
        ]);
    }

    #[Route('/{_locale<en|ru>}/design/{designId}/', name: 'design')]
    public function design(string $_locale, int $designId, Request $request, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findByDesign($designId, $_locale);
        return $this->render('collection/design.html.twig', [
            'products' => $products,
        ]);
    }
}
