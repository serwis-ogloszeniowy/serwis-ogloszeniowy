<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class YourAds extends AbstractController
{

    /**
     * @Route("/yourads", name="yourads")
     */
    public function index()
    {
        return $this->render('yourads.html.twig');
    }
}