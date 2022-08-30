<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/news/', name: 'news')]
    public function index(string $_locale, NewsRepository $newsRepository, Request $request): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $newsRepository->getPaginatorByLocale($_locale, $offset);

        for ($offset = 0, $pages = []; $offset < count($paginator); $offset += NewsRepository::PAGINATOR_PER_PAGE) {
            $pages[] = $offset;
        }

        return $this->render('news/index.html.twig', [
            'news' => $paginator,
            'pages' => $pages,
        ]);
    }
}
