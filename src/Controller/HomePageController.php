<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

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
            'categories' => $this->categoryRepository->findAll()
  		]);
    }

}
