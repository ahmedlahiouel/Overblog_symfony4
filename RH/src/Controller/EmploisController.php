<?php

namespace App\Controller;

use App\Entity\Emplois;
use App\Entity\User;
use App\Form\EmploisFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmploisController extends Controller
{
    /**
     * @Route("/emplois", name="emplois")
     */
    public function index()
    {
        return $this->render('emplois/index.html.twig', [
            'controller_name' => 'EmploisController',
        ]);
    }


    /**
     * @Route("/AddemploisModif/{id}", name="AddemploisModif")
     */
    public function AddemploisModifAction(Request $request, $id)
    {
        $Emplois = new Emplois();
        $form = $this->createForm(EmploisFormType::class, $Emplois);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Emplois->addUser($modeles);


                $em->persist($Emplois);
                $em->persist($Emplois);
                $em->flush();
                $this->addFlash("success", "Emplois Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/emploismodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/emploismodifadd.html.twig', array('form' => $form->createView()));
    }





    /**
     * @Route("/deleteemplois/{id}/{idc}", name="deleteemplois")
     */
    public function DeletemploisAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Emplois::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Emplois supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatemplois/{id}/{idc}", name="updatemplois")
     */

    public function editemploisAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Emplois::class)->find($id);
        $form = $this->createForm(EmploisFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour d'Emploi  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/EmploisModif.html.twig', array('form' => $form->createView()));
    }




}
