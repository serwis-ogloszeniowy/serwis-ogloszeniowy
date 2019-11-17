<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutUs extends AbstractController
{

    /**
     * @Route("/aboutus", name="aboutus")
     */
    public function index()
    {
        return $this->render('about_us.html.twig');
    }
}