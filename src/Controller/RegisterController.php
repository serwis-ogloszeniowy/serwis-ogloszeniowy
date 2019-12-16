<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Repository\UserRepository;

class RegisterController extends AbstractController
{
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/register", name="user_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($this->checkIfUserExists(
                    $form->get('login')->getData(),
                    $form->get('email')->getData())
                == false
            ) {
                $this->addFlash(
                    'notice',
                    'Konto o danym loginie bądź haśle już istnieje'
                );

                return $this->redirectToRoute('user_register');
            }

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword(
                $user,
                $user->getPlainPassword()
            ));

            $user->setPassword($password);
            $user->setRole('ROLE_USER');
            $user->setDateOfRegistration(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function checkIfUserExists(string $login, string $email): bool
    {
        $checkIfLoginExist = $this->userRepository->getByLogin($login);
        $checkIfEmailExist = $this->userRepository->getByEmail($email);

        if (empty($checkIfLoginExist) && empty($checkIfEmailExist)) {
            return true;
        }

        return false;
    }
}
