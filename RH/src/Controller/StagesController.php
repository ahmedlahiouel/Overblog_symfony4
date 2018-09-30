<?php

namespace App\Controller;

use App\Entity\Stages;
use App\Entity\User;
use App\Form\StagesFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StagesController extends Controller
{
    /**
     * @Route("/stages", name="stages")
     */
    public function index()
    {
        return $this->render('stages/index.html.twig', [
            'controller_name' => 'StagesController',
        ]);
    }

    /**
     * @Route("/Addstage/{id}", name="Addstage")
     */
    public function AddstageAction(Request $request, $id)
    {
        $Stage = new Stages();
        $form = $this->createForm(StagesFormType::class, $Stage);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Stage->addUser($modeles);


                $em->persist($Stage);
                $em->persist($Stage);
                $em->flush();
                $this->addFlash("success", "Stage Ajouté avec success");

                return $this->redirectToRoute('Addstage', array('id' => $id));

            } else return $this->render('default/stage.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/stage.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/AddstageModif/{id}", name="AddstageModif")
     */
    public function AddstageModifAction(Request $request, $id)
    {
        $Stage = new Stages();
        $form = $this->createForm(StagesFormType::class, $Stage);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Stage->addUser($modeles);


                $em->persist($Stage);
                $em->persist($Stage);
                $em->flush();
                $this->addFlash("success", "Stage Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/stagemodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/stagemodifadd.html.twig', array('form' => $form->createView()));
    }





    /**
     * @Route("/deletestage/{id}/{idc}", name="deletestage")
     */
    public function DeletestageAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Stages::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Stage supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatstage/{id}/{idc}", name="updatstage")
     */

    public function editstageAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Stages::class)->find($id);
        $form = $this->createForm(StagesFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Stage  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/StageModif.html.twig', array('form' => $form->createView()));
    }














}
