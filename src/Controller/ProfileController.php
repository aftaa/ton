<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\CustomerProfileType;
use App\Form\NewPasswordType;
use App\Repository\CustomerRepository;
use App\Security\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    #[Route('/{_locale<en|ru>}/profile/password', name: 'profile-password')]
    public function newPassword(
        string $_locale,
        Request $request,
        CustomerRepository $customerRepository,
        PasswordHasher $passwordHasher,
        EntityManagerInterface $entityManager,
    ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('login');
        }

        $message = '';
        $customer = $customerRepository->find($this->getUser()->getId());
        $form = $this->createForm(NewPasswordType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $request->get('new_password')['Pass'];
            try {
                $currentPassword = $passwordHasher->hash($currentPassword);
                if ($currentPassword != $this->getUser()->getPassword()) {
                    throw new \Exception('Bad old password');
                }
                $newPassword = $request->get('new_password')['newPass']['first'];
                $newPassword = $passwordHasher->hash($newPassword);
                $customer->setPassword($newPassword);
                $entityManager->persist($customer);
                $entityManager->flush();;
            } catch (\Exception $exception) {
                $message = $exception->getMessage();
            }
        }

        return $this->render('profile/password.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }
}
