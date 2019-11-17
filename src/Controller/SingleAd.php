<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SingleAd extends AbstractController
{

    /**
     * @Route("/singlead", name="singlead")
     */
    public function index()
    {
        return $this->render('singlead.html.twig');
    }
}