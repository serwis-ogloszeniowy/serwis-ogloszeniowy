<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Authors extends AbstractController
{

    /**
     * @Route("/authors", name="authors")
     */
    public function index()
    {
        return $this->render('authors.html.twig');
    }
}