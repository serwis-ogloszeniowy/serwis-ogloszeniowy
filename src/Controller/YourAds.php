<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Form\AuctionType;
use App\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuctionRepository;
use Symfony\Component\HttpFoundation\Request;

class YourAds extends AbstractController
{

    protected $auctionRepository;

    public function __construct(
        AuctionRepository $auctionRepository
    )
    {
        $this->auctionRepository = $auctionRepository;
    }

    /**
     * @Route("/yourads", name="yourads")
     */
    public function index(AuctionRepository $auctionRepository)
    {
        $user = $this->getUser();

        $userAds =  $this->auctionRepository->getAllAuctions($user);

        return $this->render('yourads.html.twig', [
            'auctions' => $userAds
        ]);
    }

    /**
     * @Route("/yourads/new", name="yourads_new")
     */
    public function addAuction(Request $request)
    {
       $auction = new Auction();

       $form = $this->createForm(AuctionType::class, $auction);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           $files = $request->files->get('auction')['images'];

           /** @var UploadedFile */
           foreach ($files as $file) {
               $image = new Image();

               $filename = md5(uniqid()).'.'.$file->guessClientExtension();

               $image->setFilename($filename);
               $image->setPath('/asset/images/'. $filename);

               $file->move($this->getParameter('image_directory'), $filename);

               $image->setAuction($auction);

               $image->setDateOfCreation(new \DateTime());
               $image->setDateOfLastModification(new \DateTime());
               $image->setMainImage(0);
               $auction->setImages($image);
           }

           $auction->setDateOfCreation(new \DateTime());
           $auction->setDateOfUpdate(new \DateTime());
           $auction->setUser($this->getUser());
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($auction);
           $entityManager->flush();

           $this->addFlash(
               'notice',
               'SUCCESS'
           );

           return $this->redirectToRoute('yourads');
       }

        return $this->render('adcreate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/yourads/{id}/edit", name="yourads_edit")
     */
    public function editAuction(Request $request, Auction $auction)
    {
            $form = $this->createForm(AuctionType::class, $auction);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('yourads', [
                    'id' => $auction->getId(),
                ]);
            }

            return $this->render('ads/edit.html.twig', [
                'auction' => $auction,
                'form' => $form->createView()
            ]);
    }
}
