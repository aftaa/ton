<?php

namespace App\Controller;

use App\Interface\RedisManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedisController extends AbstractController
{
    #[Route('/redis/', name: 'redis_test')]
    public function index(RedisManagerInterface $redisManager): Response
    {
        $counter = $redisManager->getRedis()->incr('counter');

        return $this->render('redis/index.html.twig', [
            'counter' => $counter,
        ]);
    }
}
