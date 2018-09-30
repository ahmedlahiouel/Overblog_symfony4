<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 10/08/17
 * Time: 12:26 م
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;
use test\testBundle\Form\OffreType;


class OffretController extends Controller
{ // ajout d'un offre
    public function indexAction(Request $request)

    {
        $off = new Offre();
        $form = $this->createForm(OffreType::class, $off);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $off->setActive(false);
            $em->persist($off);
            $em->flush();
            $modeles = $em->getRepository(Offre::class)->findAll();

            $this->addFlash("success", "Offre Ajouté avec success");
            return $this->render('testtestBundle:Default:affichoffreuser.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:ajoutoffre.html.twig', array('form' => $form->createView()));
    }

// supprimer offre
    public function deleteAction(Request $request, $id)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Offre::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "offre supprimé avec success");

        return $this->redirectToRoute('gestionoffreuser');

    }

// modifier offre
    public function updateAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Offre::class)->find($id);
        $form = $this->createForm(OffreType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $modeles->setActive(false);
            $em->persist($modeles);
            $em->flush();

            $modeles = $em->getRepository(Offre::class)->findAll();
            $this->addFlash("success", "mise a jour d'offre  avec success en attente de verification du admin !!");


            return $this->render('testtestBundle:Default:affichoffreuser.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:updateoffre.html.twig', array('form' => $form->createView()));
    }


}