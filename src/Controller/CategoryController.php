<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
      $categories=$this->getDoctrine()->getRepository(Category::class)->findAll();

      return $this->render('category/index.html.twig', [
          'controller_name' => 'CategoryController',
          'categories' => $categories,
      ]);
    }

    /**
     * @Route("/category/add", name="category_add")
     */
    public function add(Request $request)
    {
      $category=new Category();
      $form=$this->createForm(CategoryType::class, $category);
      $form->handleRequest($request);

      if($form->isSubmitted()){
        $category=$form->getData();

        $em=$this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();
        return $this->redirectToRoute('category');
      }

      return $this->render('category/form.html.twig', [
        'form' => $form->createView(),
        'typeForm' => 'Add',
      ]);
    }

    /**
     * @Route("/category/edit/{id}", name="category_edit")
     */
     public function edit($id, Request $request)
     {
       $em=$this->getDoctrine()->getManager();

       $category=$em->getRepository(Category::class)->find($id);

       $form=$this->createForm(CategoryType::class, $category);
       $form->handleRequest($request);

       if($form->isSubmitted()){
         $category=$form->getData();
         $em->flush();
         return $this->redirectToRoute('category');
       }

       return $this->render('category/form.html.twig', [
         'form' => $form->createView(),
         'typeForm' => 'Edit',
       ]);
     }

     /**
      * @Route("/category/delete/{id}", name="category_delete")
      */
     public function delete($id, Request $request)
     {
       $em=$this->getDoctrine()->getManager();
       $category=$this->getDoctrine()->getRepository(Category::class)->find($id);
       $em->remove($category);
       $em->flush();

       return $this->redirectToRoute('category');
     }
}
