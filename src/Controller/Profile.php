<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Profile extends AbstractController
{

    /**
     * @Route("/profile", name="profile")
     */
    public function index()
    {
        return $this->render('profile.html.twig');
    }
}