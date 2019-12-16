<?php

namespace App\Controller;

use App\Entity\Auction;
use App\Form\AuctionType;
use App\Entity\Image;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuctionRepository;
use Symfony\Component\HttpFoundation\Request;

class YourAds extends AbstractController
{
    private const LOGIN = 'ftpuser';
    private const PASSWORD = 'changeme';
    private const FTP_SERVER = 'apache_zdjecia';
    private const SERVER_DESTINATION = '/var/www/html/ftpuser/images/';
    private const HOST_NAME = 'http://fotki.com:3381/images/';

    protected $auctionRepository;
    protected $logger;

    public function __construct(
        AuctionRepository $auctionRepository,
        LoggerInterface $logger
    ) {
        $this->auctionRepository = $auctionRepository;
        $this->logger = $logger;
    }

    /**
     * @Route("/yourads", name="yourads")
     */
    public function index(AuctionRepository $auctionRepository)
    {
        $user = $this->getUser();

        $userAds = $this->auctionRepository->getAllAuctions($user);

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

            try {
                $conId = ftp_connect(self::FTP_SERVER);
                ftp_pasv($conId, true);
                $login_result = ftp_login($conId, self::LOGIN, self::PASSWORD);

            } catch (\Exception $e) {
                $e->getMessage();
            }

            $files = $request->files->get('auction')['images'];

            /** @var UploadedFile */
            foreach ($files as $file) {

                $image = new Image();
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $image->setFilename($filename);
                $image->setPath(self::HOST_NAME . $filename);
                $upload = ftp_put($conId, self::SERVER_DESTINATION . basename($filename), $file, FTP_IMAGE);
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

            try {
                $conId = ftp_connect(self::FTP_SERVER);
                ftp_pasv($conId, true);
                $login_result = ftp_login($conId, self::LOGIN, self::PASSWORD);

            } catch (\Exception $e) {
                $e->getMessage();
            }

            $files = $request->files->get('auction')['images'];

            /** @var UploadedFile */
            foreach ($files as $file) {

                $image = new Image();
                $filename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $image->setFilename($filename);
                $image->setPath(self::HOST_NAME . $filename);
                $upload = ftp_put($conId, self::SERVER_DESTINATION . basename($filename), $file, FTP_IMAGE);
                $image->setAuction($auction);
                $image->setDateOfCreation(new \DateTime());
                $image->setDateOfLastModification(new \DateTime());
                $image->setMainImage(0);
                $auction->setImages($image);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auction);
            $entityManager->flush();

            return $this->redirectToRoute('yourads', [
                'id' => $auction->getId(),
            ]);
        }

        return $this->render('ads/edit.html.twig', [
            'auction' => $auction,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/yourads/{id}/delete_image", name="image_delete", methods={"POST"})
     */
    public function deleteImage(Request $request, Auction $auction)
    {
        $datas = $request->request->get('insert_delete');

        $entityManager = $this->getDoctrine()->getManager();

        foreach ($auction->getImagesArray() as $key => $image) {
            if ($image->getId($key) == $datas) {
                $entityManager->remove($image);
                $entityManager->flush();
            }
        }

        return $this->json(['data' => 'Udało się usunąć zdjęcie']);
        //return $this->redirectToRoute('yourads_edit');

//        $this->logger->debug(print_r($request->request->all(), true));
//        die;
    }
}
