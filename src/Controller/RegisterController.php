<?php

namespace App\Controller;

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
    public function register()
    {
        return $this->render('register.html.twig');
    }

    /**
     * @Route("/user/save", name="save_user")
     */
    public function saveUser(Request $request, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $user = new User();

        $form = $request->request->all();

        if ($this->validateRequest($form) === true
            && $this->checkIfUserExists($form['login'], $form['email']) === true
        ) {

            if (filter_var($form['email'], FILTER_VALIDATE_EMAIL) === false) {
                $this->addFlash(
                    'notice',
                    'Nieprawidłowy format adresu email'
                );
                
                return $this->redirectToRoute('user_register');
            }

            $user->setFirstname($form['firstname']);
            $user->setSurname($form['surname']);
            $user->setLogin($form['login']);
            $user->setEmail($form['email']);
            $user->setPlainPassword($form['password']);

            $password = $userPasswordEncoder->encodePassword($user, $user->getPlainPassword(
                $user,
                $user->getPlainPassword()
            ));

            $user->setPassword($password);
        }

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Konto zostało utworzone!'
            );

        } catch (\Exception $e) {
            $this->addFlash(
                'notice',
                'Nieprawidłowe dane w formularzu bądź konto z podanym adresem email lub loginem już istnieje'
            );
        }
        return $this->redirectToRoute('user_register');
    }

    public function validateRequest(array $formRequest): bool
    {
        $form = $formRequest;

        if (!empty($form['firstname'] &&
            !empty($form['surname']) &&
            !empty($form['login']) &&
            !empty($form['password']) &&
            !empty($form['email']))
        ) {

            return true;
        }

        return false;
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