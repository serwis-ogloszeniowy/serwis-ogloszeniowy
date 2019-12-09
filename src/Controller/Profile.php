<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\ChangePhoneNumberType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\FormInterface;

class Profile extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    protected $user;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function index(Request $request)
    {
        $this->user = $this->getUser();

        $formChangePassword = $this->createForm(ChangePasswordType::class, $this->user);
        $formChangePhoneNumber = $this->createForm(ChangePhoneNumberType::class, $this->user);

        $changePasswordRequest = $request->request->get('change_password');
        $changePhoneNumberRequest = $request->request->get('change_phone_number');

        if ($changePasswordRequest != null) {
            $formChangePassword->handleRequest($request);
            $this->changePassword($formChangePassword);
        }

        if ($changePhoneNumberRequest != null) {
            $formChangePhoneNumber->handleRequest($request);
            $this->changePhoneNumber($formChangePhoneNumber);
        }

        return $this->render('profile.html.twig', [
            'formChangePassword' => $formChangePassword->createView(),
            'formChangePhoneNumber' => $formChangePhoneNumber->createView()
        ]);
    }

    public function changePassword(FormInterface $form): void
    {
        if ($form->isSubmitted() && $form->isValid()) {

            try {
                $passwordEncoder = $this->passwordEncoder;

                $user = $this->user;

                $getForm = $form->getData();
                $oldPassword = $getForm->getOldPassword();

                $comparePasswords = $passwordEncoder->isPasswordValid($user, $oldPassword);

                if ($comparePasswords) {

                    $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());

                    $user->setPassword($password);

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash(
                        'notice',
                        'Twoje hasło zostało zmienione'
                    );
                } else {
                    $this->addFlash(
                        'notice',
                        'Stare hasło jest inne niż podane'
                    );
                }
            } catch (\Exception $e) {
                $this->addFlash(
                    'notice',
                    $e->getMessage()
                );
            }
        }
    }

    public function changePhoneNumber(FormInterface $formPhone): void
    {
        $user = $this->user;

        if ($formPhone->isSubmitted() && $formPhone->isValid()) {

            try {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash(
                    'phone_notice',
                    'Numer telefonu został zmieniony'
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    'phone_notice',
                    'Numer telefonu nie został zmieniony'
                );
            }
        }
    }
}
