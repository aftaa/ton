<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Form\RegistrationFormType;
use App\Repository\CustomerRepository;
use App\Security\Authenticator;
use App\Security\EmailVerifier;
use App\Security\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'register')]
    public function register(
        Request                    $request,
        PasswordHasher             $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        Authenticator              $authenticator,
        EntityManagerInterface     $entityManager,
        CustomerRepository         $customerRepository,
        TranslatorInterface        $translator,
    ): Response
    {
        $user = new Customer();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            try {
                if ($customerRepository->findBy(['Login' => $form->get('Login')->getData()])) {
                    throw new \Exception($translator->trans('Login exists'));
                }
                if ($customerRepository->findBy(['Email' => $form->get('Email')->getData()])) {
                    throw new \Exception($translator->trans('Email exists'));
                }

                $user->setPassword(
                    $userPasswordHasher->hash(
                        $form->get('plainPassword')->getData()
                    )
                );
                $user->setFName('');
                $user->setSName('');
                $user->setLName('');
                $user->setMetro('');
                $entityManager->persist($user);
                $entityManager->flush();// generate a signed url and email it to the user
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('after@ya.ru', 'Mail Bot'))
                        ->to($user->getEmail())
                        ->subject('Please Confirm your Email')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );// do anything else you need here, like send an email

                $this->addFlash('verify_email_error', 'Check your email');

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            } catch (\Exception $e) {
                $this->addFlash('verify_email_error', $e->getMessage());
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, CustomerRepository $customerRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('register');
        }

        $user = $customerRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('register');
    }
}
