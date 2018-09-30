<?php

namespace App\Controller;

use App\Entity\Avantages;
use App\Entity\User;
use App\Form\AvantageFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AvatnageController extends Controller
{
    /**
     * @Route("/avatnage", name="avatnage")
     */
    public function index()
    {
        return $this->render('avatnage/index.html.twig', [
            'controller_name' => 'AvatnageController',
        ]);
    }
    /**
     * @Route("/AddAvantageModif/{id}", name="AddAvantageModif")
     */
    public function AddavatangeModifAction(Request $request, $id)
    {
        $Avantage = new Avantages();
        $form = $this->createForm(AvantageFormType::class, $Avantage);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Avantage->addUser($modeles);


                $em->persist($Avantage);
                $em->persist($Avantage);
                $em->flush();
                $this->addFlash("success", "Avantage Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/avantagemodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/avantagemodifadd.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deleteavantage/{id}/{idc}", name="deleteavantage")
     */
    public function DeletavAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Avantages::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Avantage supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatavantage/{id}/{idc}", name="updatavantage")
     */

    public function editavAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Avantages::class)->find($id);
        $form = $this->createForm(AvantageFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Avantage  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/AvantageModif.html.twig', array('form' => $form->createView()));
    }



}
