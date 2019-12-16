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
        return $this->render('category/category_management.html.twig',[
            'categories' => $this->categoryRepository->findAll()
        ]);
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
                    'category',
                    'Kategoria o tej nazwie już istnieje'
                );

                return $this->redirectToRoute('category_create');
            }

            $category->setDateOfCreation(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'category',
                'Kategoria została utworzona'
            );
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_edit")
     */
    public function edit(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'category',
                'Kategoria została zaaktualizowana'
            );

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/delete", name="category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category)
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_index');
    }
}
