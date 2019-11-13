<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class RegisterController extends AbstractController
{
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

        if($this->validateRequest($form) === true) {


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

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return  $this->redirectToRoute('home');
        }
        return  $this->redirectToRoute('user_register');
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
}