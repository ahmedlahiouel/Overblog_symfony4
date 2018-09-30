<?php

namespace App\Controller;

use App\Entity\Langues;
use App\Entity\Questions;
use App\Form\QuestionsFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QuestionsController extends Controller
{
    /**
     * @Route("/questions", name="questions")
     */
    public function index()
    {
        return $this->render('questions/index.html.twig', [
            'controller_name' => 'QuestionsController',
        ]);
    }
    /**
     * @Route("/gestionquestion", name="gestionquestion")
     */
    public function questAction()
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Questions::class)->findAll();

    return $this->render('default/listequestion.html.twig', array('listequestion'=>$modeles));


    }
    /**
     * @Route("/crerquestion", name="crerquestion")
     */
    public function AddquestionAction(Request $request)
    {

        $quest = new Questions();
        $form = $this->createForm(QuestionsFormType::class, $quest);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($quest);
                $em->flush();
                $this->addFlash("success", "Question Ajouté avec success");

                return $this->redirectToRoute('gestionquestion');

            } else return $this->render('default/addquest.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/addquest.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deletquestion/{id}", name="deletquestion")
     */
    public function DeletquestAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Questions::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Question supprimé avec success");

        return $this->redirectToRoute('gestionquestion');
    }

    /**
     * @Route("/updatquestion/{id}", name="updatquestion")
     */
    public function updatequesAction(Request $request, $id)
    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Questions::class)->find($id);
        $form = $this->createForm(QuestionsFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Question  avec success");

            return $this->redirectToRoute('gestionquestion');



        } else return $this->render('default/questionModif.html.twig', array('form' => $form->createView()));
    }


}
