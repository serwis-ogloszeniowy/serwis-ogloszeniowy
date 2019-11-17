<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Adcreate extends AbstractController
{

    /**
     * @Route("/adcreate", name="adcreate")
     */
    public function index()
    {
        return $this->render('adcreate.html.twig');
    }
}