<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;
use App\Form\QuestionType;

class QuestionController extends AbstractController
{
    /**
     * @Route("/question", name="question")
     */
     public function index()
     {
       $questions=$this->getDoctrine()->getRepository(Question::class)->findAll();

       return $this->render('question/index.html.twig', [
           'controller_name' => 'QuestionController',
           'questions' => $questions,
       ]);
     }

     /**
      * @Route("/question/add", name="question_add")
      */
     public function add(Request $request)
     {
       $question=new Question();
       $form=$this->createForm(QuestionType::class, $question);
       $form->handleRequest($request);

       if($form->isSubmitted()){
         $question=$form->getData();

         $em=$this->getDoctrine()->getManager();
         $em->persist($question);
         $em->flush();
         return $this->redirectToRoute('question');
       }

       return $this->render('question/form.html.twig', [
         'form' => $form->createView(),
         'typeForm' => 'Add',
       ]);
     }

     /**
      * @Route("/question/edit/{id}", name="question_edit")
      */
      public function edit($id, Request $request)
      {
        $em=$this->getDoctrine()->getManager();

        $question=$em->getRepository(Question::class)->find($id);

        $form=$this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted()){
          $question=$form->getData();
          $em->flush();
          return $this->redirectToRoute('question');
        }

        return $this->render('question/form.html.twig', [
          'form' => $form->createView(),
          'typeForm' => 'Edit',
        ]);
      }

      /**
       * @Route("/question/delete/{id}", name="question_delete")
       */
      public function delete($id, Request $request)
      {
        $em=$this->getDoctrine()->getManager();
        $question=$this->getDoctrine()->getRepository(Question::class)->find($id);
        $em->remove($question);
        $em->flush();

        return $this->redirectToRoute('question');
      }
}
