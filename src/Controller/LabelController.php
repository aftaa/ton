<?php

namespace App\Controller;

use App\Repository\LabelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LabelController extends AbstractController
{
    #[Route('/{_locale<en|ru>}/labels/', name: 'aside_labels')]
    public function asideLabels(string $_locale, LabelRepository $labelRepository, RequestStack $requestStack): Response
    {
        $request = $requestStack->getMainRequest();
        $query = $request->query;
        $labels = $labelRepository->findForMenu(
            $_locale,
            $query->getInt('typeId', 0),
            $query->getInt('designId', 0),
        );
        foreach ($labels as &$label) {
            $uri = [];
            if ($query->has('typeId')) {
                $uri['typeId'] = $query->getInt('typeId');
            }
            $uri['labelId'] = $label['id'];
            if ($query->has('designId')) {
                $uri['designId'] = $query->getInt('designId');
            }
            $label['uri'] = $uri;

            $label['active'] = $query->getInt('labelId', 0) == $label['id'];
        }

        $resetUri = [];
        if ($query->has('typeId')) {
            $resetUri['typeId'] = $query->getInt('typeId');
        }
        if ($query->has('designId')) {
            $resetUri['designId'] = $query->getInt('designId');
        }

        return $this->render('label/aside_labels.html.twig', [
            'labels' => $labels,
            'resetUri' => $resetUri,
        ]);
    }
}
