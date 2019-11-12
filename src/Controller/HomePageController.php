<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/register.html", name="register")
     */
    public function register()
    {
        return $this->render('register.html.twig');
    }

    /**
     * @Route("/login.html", name="login")
     */
    public function login()
    {
        return $this->render('login.html.twig');
    }
}