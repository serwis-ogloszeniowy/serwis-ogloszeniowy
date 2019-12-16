<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\AuctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    protected $categoryRepository;
    protected $auctionRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        AuctionRepository $auctionRepository
    )  {
        $this->categoryRepository = $categoryRepository;
        $this->auctionRepository = $auctionRepository;
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
            'categories' => $this->categoryRepository->findAll(),
            'auctions' => $this->auctionRepository->findBy([], ['id' => 'DESC']),
            'newestAuctions' => $this->auctionRepository->getLatestAuctions()
  		]);
    }

}
