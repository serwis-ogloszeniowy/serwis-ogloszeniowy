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
    	$logged_in = 0;
    	if ($this->isGranted('ROLE_USER') == false) {
    		$logged_in = 1;
  		}
  		else {
  			$logged_in = 0;
  		}
  		return $this->render('home.html.twig', [
  			'logged_in' => $logged_in,
  		]);

    }

}
