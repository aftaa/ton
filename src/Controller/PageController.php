<?php

namespace App\Controller;

use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

#[Route('/{_locale<en|ru>}')]
class PageController extends AbstractController
{
    public function __construct(
        private readonly Environment    $twig,
        private readonly PageRepository $pageRepository,
    )
    {
    }

    #[Route('/contacts/', name: 'contacts')]
    public function contacts(string $_locale): Response
    {
        return $this->getPage(PageRepository::CONTACTS, $_locale);
    }

    #[Route('/delivery/', name: 'delivery')]
    public function delivery(string $_locale): Response
    {
        return $this->getPage(PageRepository::DELIVERY, $_locale);
    }

    #[Route('/wholesale/', name: 'wholesale')]
    public function wholesale(string $_locale)
    {
        return $this->getPage(PageRepository::WHOLESALE, $_locale);
    }

    private function getPage(int $pageId, string $_locale): Response
    {
        $page = $this->pageRepository->find($pageId);
        return new Response($this->twig->render('page/index.html.twig', [
            'content' => $page->getContentByLocale($_locale),
            'title' => $page->getTitleByLocale($_locale),
            'description' => $page->getDescription(),
            'keywords' => $page->getKeywords(),
        ]));
    }
}
