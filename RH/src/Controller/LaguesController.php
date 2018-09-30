<?php

namespace App\Controller;

use App\Entity\Langues;
use App\Entity\User;
use App\Form\LanguesFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LaguesController extends Controller
{
    /**
     * @Route("/lagues", name="lagues")
     */
    public function index()
    {
        return $this->render('lagues/index.html.twig', [
            'controller_name' => 'LaguesController',
        ]);
    }

    /**
     * @Route("/AddLanguesModif/{id}", name="AddLanguesModif")
     */
    public function AddLangueModifAction(Request $request, $id)
    {
        $Langue = new Langues();
        $form = $this->createForm(LanguesFormType::class, $Langue);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Langue->addUser($modeles);


                $em->persist($Langue);
                $em->persist($Langue);
                $em->flush();
                $this->addFlash("success", "Langues Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/languemodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/languemodifadd.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/deletelangue/{id}/{idc}", name="deletelangue")
     */
    public function DeletelangueAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Langues::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Langues supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatlangue/{id}/{idc}", name="updatlangue")
     */

    public function editlangueAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Langues::class)->find($id);
        $form = $this->createForm(LanguesFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Langues  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/LanguesModif.html.twig', array('form' => $form->createView()));
    }
















}
