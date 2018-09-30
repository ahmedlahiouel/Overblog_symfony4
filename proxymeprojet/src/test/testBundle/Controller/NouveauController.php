<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 09/08/17
 * Time: 03:02 م
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\categorie;
use test\testBundle\Entity\Rendez_vous;
use test\testBundle\Form\categorieType;

class NouveauController extends Controller
{ // afficher les categories
    public function indexAction()

    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(categorie::class)->findAll();

        return $this->render('testtestBundle:Default:test.html.twig', array('modeles' => $modeles));
    }

// supprimer les categories
    public function deleteAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(categorie::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "categorie supprimé avec success");

        return $this->redirectToRoute('hy');


    }

// mise a jour des categories
    public function miseAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(categorie::class)->find($id);
        $form = $this->createForm(categorieType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $modeles = $em->getRepository(categorie::class)->findAll();
            $this->addFlash("success", "mise a jour de categorie  avec success");


            return $this->render('testtestBundle:Default:test.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:updatecateg.html.twig', array('form' => $form->createView()));
    }

// ajouter des categories
    public function ajoutAction(Request $request)
    {
        $categ = new categorie();
        $form = $this->createForm(categorieType::class, $categ);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categ);
            $em->flush();
            $modeles = $em->getRepository(categorie::class)->findAll();

            $this->addFlash("success", "categorie Ajouté avec success");
            return $this->render('testtestBundle:Default:test.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:ajoutcateg.html.twig', array('form' => $form->createView()));
    }

// recherche des categories
    public function rechercheAction(Request $request)
    {

        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(categorie::class)->findAll();

        $resut = [];
        if ($request->isMethod("POST")) {
            $typec = $request->get('typec');
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery("SELECT u FROM testtestBundle:categorie u WHERE u.type =:pay")
                ->setParameter('pay', $typec);
            $resut = $query->getResult();
        }
        return $this->render('testtestBundle:Default:recherche.html.twig', array('modeles' => $resut));

    }
    public function affich_calenderAction(Request $request)
    {
        $usercon = $this->getUser();
        $id_user_connecte = $usercon->getId();
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository(Rendez_vous::class)->findBy((array('usersoc' => $id_user_connecte)));



        return $this->render('testtestBundle:Default:full_calend.html.twig', array('modeles' => $modeles));

    }





}