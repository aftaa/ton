<?php

namespace App\Tests\Controller;

use App\Tests\CartAssertionsTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

class CartControllerTest extends WebTestCase
{
    use CartAssertionsTrait;

    private function getRandomDesign(AbstractBrowser $client): array
    {
        $crawler = $client->request('GET', '/ru/collection/');
        $productNode = $crawler->filter('.card')->eq(0);
        $productName = $productNode->filter('.card-title')->getNode(0)->textContent;
        $productLink = $productNode->filter('.btn-dark')->link();

        return [
            'name' => $productName,
            'url' => $productLink->getUri()
        ];
    }

    private function addRandomProductToCart(AbstractBrowser $client, int $quantity = 1): array
    {
        $design = $this->getRandomDesign($client);
        $crawler = $client->request('GET', $design['url']);
        $productNode = $crawler->filter('.product');
        $productNode = $productNode->getNode(0);
        $product['url'] = $crawler->selectLink($design['name'])->link();
        $crawler = $client->click($product['url']);

        $product['name'] = $crawler->filter('h1')->getNode(0)->textContent;
        $product['price'] = $crawler->filter('.price')->getNode(0)->textContent;
        $product['price'] = str_replace(' ', '', $product['price']);
        $form = $crawler->filter('form')->form();
        $form->setValues(['add_to_cart[Quantity]' => $quantity]);
        $client->submit($form);
        return $product;
    }

    public function createClient1(): KernelBrowser
    {
        return static::createClient([], [
            'HTTP_HOST' => 'ton:82',
        ]);
    }

    public function testCartIsEmpty()
    {
        $client = $this->createClient1();
        $crawler = $client->request('GET', '/ru/cart/');

        $this->assertResponseIsSuccessful();
        $this->assertCartIsEmpty($crawler);
    }

    public function testAddProductToCart()
    {
        $client = $this->createClient1();
        $product = $this->addRandomProductToCart($client);
        $crawler = $client->request('GET', '/cart/');

        $this->assertResponseIsSuccessful();
        $this->assertCartItemsCountEquals($crawler, 1);
        $crawler = $client->request('GET', '/cart/');
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 1);
        $this->assertCartTotalEquals($crawler, $product['price']);
    }

    public function testAddProductTwiceToCart()
    {
        $client = $this->createClient1();

        // Gets a random product form the homepage
        $design = $this->getRandomDesign($client);

        // Go to a product page from
        $crawler = $client->request('GET', $design['url']);
        $product['url'] = $crawler->selectLink($design['name'])->link()->getUri();
        // Adds the product twice to the cart
        for ($i = 0; $i < 2; $i++) {
            $crawler = $client->request('GET', $product['url']);
            $product['name'] = $crawler->filter('h1')->getNode(0)->textContent;
            $product['price'] = $crawler->filter('.price')->getNode(0)->textContent;
            $product['price'] = str_replace(' ', '', $product['price']);
            $form = $crawler->filter('form')->form();
            $form->setValues(['add_to_cart[Quantity]' => 1]);
            $client->submit($form);
//            $this->assertTrue($client->getResponse()->isRedirection());
//            $crawler = $client->followRedirect();
//            $crawler = $client->request('GET', $product['url']);
        }

        // Go to the cart
        $crawler = $client->request('GET', '/cart/');

        $this->assertResponseIsSuccessful();
        $this->assertCartItemsCountEquals($crawler, 1);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 2);
        $this->assertCartTotalEquals($crawler, $product['price'] * 2);
    }

    public function testRemoveProductFromCart()
    {
        $client = $this->createClient1();
        $product = $this->addRandomProductToCart($client);

        // Go to the cart page
        $client->request('GET', '/ru/cart/');

        // Removes the product from the cart
        $client->submitForm('Удалить');
//        $crawler = $client->followRedirect();
        $crawler = $client->request('GET', '/ru/cart/');

        $this->assertCartNotContainsProduct($crawler, $product['name']);
    }

    public function testClearCart()
    {
        $client = $this->createClient1();
        $this->addRandomProductToCart($client);

        // Go to the cart page
        $client->request('GET', '/cart');

        // Clears the cart
        $client->submitForm('Очистить');
        $crawler = $client->followRedirect();

        $this->assertCartIsEmpty($crawler);
    }

    public function testUpdateQuantity()
    {
        $client = static::createClient();
        $product = $this->addRandomProductToCart($client);

        // Go to the cart page
        $crawler = $client->request('GET', '/cart');

        // Updates the quantity
        $cartForm = $crawler->filter('.col-md-8 form')->form([
            'cart[items][0][quantity]' => 4
        ]);
        $client->submit($cartForm);
        $crawler = $client->followRedirect();

        $this->assertCartTotalEquals($crawler, $product['price'] * 4);
        $this->assertCartContainsProductWithQuantity($crawler, $product['name'], 4);
    }
}
