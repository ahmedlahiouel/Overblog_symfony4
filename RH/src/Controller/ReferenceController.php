<?php

namespace App\Controller;

use App\Entity\Reference;
use App\Entity\User;
use App\Form\RefFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReferenceController extends Controller
{
    /**
     * @Route("/reference", name="reference")
     */
    public function index()
    {
        return $this->render('reference/index.html.twig', [
            'controller_name' => 'ReferenceController',
        ]);
    }

    /**
     * @Route("/AddReferenceModif/{id}", name="AddReferenceModif")
     */
    public function AddrefModifAction(Request $request, $id)
    {
        $ref = new Reference();
        $form = $this->createForm(RefFormType::class, $ref);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $ref->addUser($modeles);


                $em->persist($ref);
                $em->persist($ref);
                $em->flush();
                $this->addFlash("success", "Reference Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/refmodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/refmodifadd.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/deletereference/{id}/{idc}", name="deletereference")
     */
    public function DeleterefernceAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Reference::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Reference supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatreference/{id}/{idc}", name="updatreference")
     */

    public function editreferenceAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Reference::class)->find($id);
        $form = $this->createForm(RefFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Reference  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/refModif.html.twig', array('form' => $form->createView()));
    }



















}
