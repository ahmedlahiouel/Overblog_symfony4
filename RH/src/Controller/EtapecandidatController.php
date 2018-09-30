<?php

namespace App\Controller;

use App\Entity\Avantages;
use App\Entity\Cursus;
use App\Entity\Emplois;
use App\Entity\Langues;
use App\Entity\Reference;
use App\Entity\Stages;
use App\Entity\User;
use App\Form\AvantageFormType;
use App\Form\CursusFormType;
use App\Form\EmploisFormType;
use App\Form\LanguesFormType;
use App\Form\RefFormType;
use App\Form\StagesFormType;
use App\Form\UpdateUserFormType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EtapecandidatController extends Controller
{
    /**
     * @Route("/etapecandidat", name="etapecandidat")
     */
    public function index()
    {
        return $this->render('etapecandidat/index.html.twig', [
            'controller_name' => 'EtapecandidatController',
        ]);
    }

    /**
     * @Route("/etape1", name="etape1")
     */
    public function Etape1Action(Request $request)

    {



        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($this->getUser()->getId());
        $form = $this->createForm(UpdateUserFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $modeles->setEtape('1');
                $em->persist($modeles);
                $em->flush();

                $us = $this->getUser();
                $id = $us->getId();
                $this->addFlash("success", "mise a jour   avec success en attente de verification du admin !!");

                $url = $this->generateUrl('etape2');

                $response = new RedirectResponse($url);
                return $response;

            } else return $this->render('views/Registration/Etape1candidat.html.twig', array('form' => $form->createView()));
        } else return $this->render('views/Registration/Etape1candidat.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/etape2", name="etape2")
     */
    public function Etap2Action(Request $request)
    {
        $Cursus = new Cursus();
        $form = $this->createForm(CursusFormType::class, $Cursus);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
                $modeles->setEtape('2');
                $em->persist($modeles);
                $em->flush();

                $Cursus->addUser($modeles);


                $em->persist($Cursus);
                $em->persist($Cursus);
                $em->persist($modeles);

                $em->flush();
                $this->addFlash("success", "Cursus Ajouté avec success Vous Pouvez Ajouté Un Autre ");

                return $this->redirectToRoute('etape2');

            } else return $this->render('etapecandidat/etape2.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape2.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/etape3", name="etape3")
     */
    public function Etape3Action(Request $request)
    {
        $Stage = new Stages();
        $form = $this->createForm(StagesFormType::class, $Stage);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
                $modeles->setEtape('3');
                $em->persist($modeles);
                $em->flush();


                $Stage->addUser($modeles);


                $em->persist($Stage);
                $em->persist($Stage);
                $em->flush();

                $this->addFlash("success", "Stage Ajouté avec success Vous Pouvez Ajouté Un Autre");

                return $this->redirectToRoute('etape3');

            } else return $this->render('etapecandidat/etape3.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape3.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/etape4", name="etape4")
     */
    public function Etape4Action(Request $request)
    {
        $Emplois = new Emplois();
        $form = $this->createForm(EmploisFormType::class, $Emplois);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
                $modeles->setEtape('4');
                $em->persist($modeles);
                $em->flush();
                $Emplois->addUser($modeles);


                $em->persist($Emplois);
                $em->persist($Emplois);
                $em->flush();
                $this->addFlash("success", "Emploi Ajouté avec success Vous Pouvez Ajouté Un Autre ");

                return $this->redirectToRoute('etape4');

            } else return $this->render('etapecandidat/etape4.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape4.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/etape5", name="etape5")
     */
    public function Etape5Action(Request $request)
    {
        $Avantag = new Avantages();
        $form = $this->createForm(AvantageFormType::class, $Avantag);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
$modeles->setEtape('5');
$em->persist($modeles);
$em->flush();
                $Avantag->addUser($modeles);


                $em->persist($Avantag);
                $em->persist($Avantag);
                $em->flush();
                $this->addFlash("success", "Avantage Ajouté avec success Vous Pouvez Ajouté Un Autre ");

                return $this->redirectToRoute('etape5');

            } else return $this->render('etapecandidat/etape5.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape5.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/etape6", name="etape6")
     */
    public function etape6Action(Request $request)
    {
        $Langue = new Langues();
        $form = $this->createForm(LanguesFormType::class, $Langue);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
$modeles->setEtape('6');
$em->persist($modeles);
$em->flush();
                $Langue->addUser($modeles);


                $em->persist($Langue);
                $em->persist($Langue);
                $em->flush();
                $this->addFlash("success", "Langues Ajouté avec success Vous Pouvez Ajouté Une Autre Langue");

                return $this->redirectToRoute('etape6');

            } else return $this->render('etapecandidat/etape6.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape6.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/etape7", name="etape7")
     */
    public function Etape7Action(Request $request)
    {
        $Ref = new Reference();
        $form = $this->createForm(RefFormType::class, $Ref);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());
$modeles->setEtape('7');
$em->persist($modeles);
$em->flush();
                $Ref->addUser($modeles);


                $em->persist($Ref);
                $em->persist($Ref);
                $em->flush();
                $this->addFlash("success", "Reference Ajouté avec success Vous Pouvez Ajouté Une Autre Reference");

                return $this->redirectToRoute('Questionexp');

            } else return $this->render('etapecandidat/etape7.html.twig', array('form' => $form->createView()));

        } else return $this->render('etapecandidat/etape7.html.twig', array('form' => $form->createView()));
    }
}
