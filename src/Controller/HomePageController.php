<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="dupa")
     */
    public function index()
    {
        $zmienna = 'witaj';

        return $this->render('home.html.twig', ['zmienna' => $zmienna]);
    }

    /**
     * @Route("/test", name="home")
     */
    public function test()
    {

        $zmienna = 'witaj';

        return $this->render('home.html.twig', ['zmienna' => $zmienna]);
    }
}