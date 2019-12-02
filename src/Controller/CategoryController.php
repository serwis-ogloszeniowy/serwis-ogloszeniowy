<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\CategoryRepository;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @var CategoryRepository 
     */
    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/index", name="category_index", methods={"GET"})
     */
    public function index()
    {
        return $this->render('category/category_management.html.twig');
    }

    /**
     * @Route("/new", name="category_create")
     */
    public function new(Request $request): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        $requestData = $request->request->get('category');

        if ($form->isSubmitted() && $form->isValid()) {

            if(!empty($this->categoryRepository->getByName($requestData['name']))){
                $this->addFlash(
                    'notice',
                    'Kategoria o tej nazwie już istnieje'
                );

                return $this->redirectToRoute('category_create');
            }

            $category->setDateOfCreation(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Kategoria została utworzona'
            );
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
