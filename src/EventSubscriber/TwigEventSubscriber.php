<?php

namespace App\EventSubscriber;

use App\Repository\TypeRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly Environment    $twig,
        private readonly TypeRepository $typeRepository,
    )
    {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $request = $event->getRequest();
        $query = $request->query;
        $menu = $this->typeRepository->findBy(
            $request->getLocale(),
            $query->getInt('labelId', 0),
            $query->getInt('designId', 0),
        );
        $this->setGetParams($menu, $query);
        $this->twig->addGlobal('types', $menu);
        $this->twig->addGlobal('resetUri', $this->getResetUri($query));
        $this->twig->addGlobal('lang', $this->getLang($request));
    }

    /**
     * @param array $menu
     * @param InputBag $query
     * @return void
     */
    public function setGetParams(array& $menu, InputBag $query): void
    {
        foreach ($menu as &$item) {
            $uri = ['typeId' => $item['id']];
            if ($query->has('labelId')) {
                $uri['labelId'] = $query->getInt('labelId');
            }
            if ($query->has('designId')) {
                $uri['designId'] = $query->getInt('designId');
            }
            $item['uri'] = $uri;

            $item['active'] = $query->getInt('typeId', 0) == $item['id'];
        }
    }

    /**
     * @param InputBag $query
     * @return array
     */
    public function getResetUri(InputBag $query): array
    {
        $resetUri = [];
        if ($query->has('labelId')) {
            $resetUri['labelId'] = $query->getInt('labelId');
        }
        if ($query->has('designId')) {
            $resetUri['designId'] = $query->getInt('designId');
        }
        return $resetUri;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getLang(Request $request): array
    {
        if ($request->get('_route_params')) {
            $params = $request->get('_route_params') + $request->query->all();
        } else {
            $params = $request->query->all();
        }
        $params['_locale'] = 'ru' == $request->getLocale() ? 'en' : 'ru';
        return [
            'href' => $request->get('_route'),
            'params' => $params,
            'name' => $params['_locale'],
        ];
    }
}