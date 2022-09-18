<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\NewsRepository;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class IndexController extends AbstractController
{
    #[Route('/')]
    public function indexNoLocale(): RedirectResponse
    {
        return $this->redirectToRoute('index', ['_locale' => 'ru']);
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    #[Route('/{_locale<en|ru>}/', name: 'index')]
    public function index(
        string $_locale,
        Environment $twig,
        PageRepository $pageRepository,
        ArticleRepository $articleRepository,
        NewsRepository $newsRepository,
    ): Response
    {
        $page = $pageRepository->find(PageRepository::INDEX);
        $pageBottom = $pageRepository->find(PageRepository::INDEX_BOTTOM);
        return new Response($twig->render('index/index.html.twig', [
            'content' => $page->getContentByLocale($_locale),
            'title' => $pageBottom->getTitleByLocale($_locale),
            'description' => $page->getDescription(),
            'keywords' => $page->getKeywords(),
            'content_bottom' => $pageBottom->getContentByLocale($_locale),
            'articles' => $articleRepository->findForIndex(),
            'news' => $newsRepository->findForIndex($_locale),
        ]));
    }
}
