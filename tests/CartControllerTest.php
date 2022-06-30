<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CartControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    private function getRandomProduct(AbstractBrowser $client): array
    {
        $crawler = $client->request('GET', '/');
        $productNode = $crawler->filter('.card')->eq(rand(0, 9));
        $productName = $productNode->filter('.card-title')->getNode(0)->textContent;
        $productPrice = (float)$productNode->filter('span.h5')->getNode(0)->textContent;
        $productLink = $productNode->filter('.btn-dark')->link();

        return [
            'name' => $productName,
            'price' => $productPrice,
            'url' => $productLink->getUri()
        ];
    }
}
