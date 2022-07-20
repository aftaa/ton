<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedisController extends AbstractController
{
    #[Route('/redis/', name: 'redis_test')]
    public function index(): Response
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1');

        if (!$redis->exists('counter')) {
            $redis->set('counter', '0');
        }

        $counter = $redis->incr('counter');

        return $this->render('redis/index.html.twig', [
            'counter' => $counter,
        ]);
    }
}
