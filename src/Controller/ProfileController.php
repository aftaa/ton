<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerProfileType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{


    #[Route('/{_locale<ru|en>}/profile/', name: 'profile')]
    public function index(
        $_locale,
        Request $request,
        CustomerRepository $customerRepository,
        EntityManagerInterface $entityManager,
    ): Response
    {
        /** @var Customer $user */
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('login');
        }

        $customer = $customerRepository->find($user->getId());

        if (!$customer) {
            throw new NotFoundHttpException('Пользователь не найден');
        }

        $form = $this->createForm(CustomerProfileType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($customer);
            $entityManager->flush();
            return $this->redirectToRoute('profile');
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
