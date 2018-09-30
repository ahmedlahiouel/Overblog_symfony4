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

class CandidatController extends Controller
{
    /**
     * @Route("/candidat", name="candidat")
     */
    public function index()
    {
        return $this->render('candidat/index.html.twig', [
            'controller_name' => 'CandidatController',
        ]);
    }
    /**
     * @Route("/affichehomepersonne", name="affichehomepersonne")
     */
    public function showAction()
//afficher liste des user pour l admin
    {

        return $this->render('interfacehomepers.html.twig');
    }
    /**
     * @Route("/showinformation", name="showinformation")
     */
    public function showinfoAction()

    { $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()->select('p')
            ->from('App:Cursus', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb2 = $em->createQueryBuilder()->select('p')
            ->from('App:Stages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb3 = $em->createQueryBuilder()->select('p')
            ->from('App:Emplois', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb4 = $em->createQueryBuilder()->select('p')
            ->from('App:Avantages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb5 = $em->createQueryBuilder()->select('p')
            ->from('App:Langues', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb6 = $em->createQueryBuilder()->select('p')
            ->from('App:Reference', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($this->getUser()->getId());

        return $this->render('default/profilcandidat.html.twig',array('modeles'=>$modeles,'modeles2'=>$qb,'stages'=>$qb2,'modeles3'=>$qb3,'listeavantages'=>$qb4,'listelangues'=>$qb5,'listereference'=>$qb6));

    }
    /**
     * @Route("/updatecandiself", name="updatecandiself")
     */
    public function updatcandidatAction(Request $request)

    {

        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()->select('p')
            ->from('App:Cursus', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb2 = $em->createQueryBuilder()->select('p')
            ->from('App:Stages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb3 = $em->createQueryBuilder()->select('p')
            ->from('App:Emplois', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb4 = $em->createQueryBuilder()->select('p')
            ->from('App:Avantages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb5 = $em->createQueryBuilder()->select('p')
            ->from('App:Langues', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $qb6 = $em->createQueryBuilder()->select('p')
            ->from('App:Reference', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid',$this->getUser()->getId())
            ->getQuery()
            ->getResult();
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($this->getUser()->getId());
        $form = $this->createForm(UpdateUserFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($modeles);
                $em->flush();

                $us = $this->getUser();
                $id = $us->getId();
                $this->addFlash("success", "mise a jour   avec success en attente de verification du admin !!");

                $url = $this->generateUrl('showinformation');

                $response = new RedirectResponse($url);
return $response;

            } else return $this->render('views/Registration/updatecandidat.html.twig', array('form' => $form->createView(), 'modeles' => $qb,'listestage'=>$qb2,'listeemplois'=>$qb3,'listeavantages'=>$qb4,'listelangues'=>$qb5,'listereference'=>$qb6,'idcandidat' => $this->getUser()->getId()));
        } else return $this->render('views/Registration/updatecandidat.html.twig', array('form' => $form->createView(), 'modeles' => $qb,'listestage'=>$qb2,'listeemplois'=>$qb3,'listeavantages'=>$qb4,'listelangues'=>$qb5,'listereference'=>$qb6,'idcandidat' => $this->getUser()->getId()));
    }
    /**
     * @Route("/updatcursuscandi/{id}", name="updatcursuscandi")
     */

    public function editcursusAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Cursus::class)->find($id);
        $form = $this->createForm(CursusFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Cursus  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/cursusModifcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deletecursuscandi/{id}", name="deletecursuscandi")
     */
    public function DeletecursusAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Cursus::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Cursus supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/Addcursuscandi", name="Addcursuscandi")
     */
    public function AddcursusModifAction(Request $request)
    {
        $Cursus = new Cursus();
        $form = $this->createForm(CursusFormType::class, $Cursus);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Cursus->addUser($modeles);


                $em->persist($Cursus);
                $em->persist($Cursus);
                $em->flush();
                $this->addFlash("success", "Cursus Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/cursusmodifaddcan.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/cursusmodifaddcan.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/AddstageModifcandi", name="AddstageModifcandi")
     */
    public function AddstageModifAction(Request $request)
    {
        $Stage = new Stages();
        $form = $this->createForm(StagesFormType::class, $Stage);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Stage->addUser($modeles);


                $em->persist($Stage);
                $em->persist($Stage);
                $em->flush();
                $this->addFlash("success", "Stage Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/stagemodifaddcandi.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/stagemodifaddcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deletestagecandi/{id}", name="deletestagecandi")
     */
    public function DeletestageAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Stages::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Stage supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/updatstagecandi/{id}", name="updatstagecandi")
     */

    public function editstageAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Stages::class)->find($id);
        $form = $this->createForm(StagesFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Stage  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/StageModifcandi.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/AddemploisModifcandi", name="AddemploisModifcandi")
     */
    public function AddemploisModifAction(Request $request)
    {
        $Emplois = new Emplois();
        $form = $this->createForm(EmploisFormType::class, $Emplois);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Emplois->addUser($modeles);


                $em->persist($Emplois);
                $em->persist($Emplois);
                $em->flush();
                $this->addFlash("success", "Emplois Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/emploismodifaddcandi.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/emploismodifaddcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deleteemploiscandi/{id}", name="deleteemploiscandi")
     */
    public function DeletemploisAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Emplois::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Emplois supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/updatemploiscandi/{id}", name="updatemploiscandi")
     */

    public function editemploisAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Emplois::class)->find($id);
        $form = $this->createForm(EmploisFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Emplois  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/EmploisModifcandi.html.twig', array('form' => $form->createView()));
    }



    /**
     * @Route("/AddavantaModifcandi", name="AddavantaModifcandi")
     */
    public function AddavantaModifAction(Request $request)
    {
        $Avantag = new Avantages();
        $form = $this->createForm(AvantageFormType::class, $Avantag);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Avantag->addUser($modeles);


                $em->persist($Avantag);
                $em->persist($Avantag);
                $em->flush();
                $this->addFlash("success", "Avantages Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/avanatgmodifaddcandi.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/avanatgmodifaddcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deleteavantacandi/{id}", name="deleteavantacandi")
     */
    public function DeletavantaAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Avantages::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Avantages supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/updateavantacandi/{id}", name="updateavantacandi")
     */

    public function editavantagAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Avantages::class)->find($id);
        $form = $this->createForm(AvantageFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Avantage  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/AvantageModifcandi.html.twig', array('form' => $form->createView()));
    }




    /**
     * @Route("/AddlangueModifcandi", name="AddlangueModifcandi")
     */
    public function AddlanguModifAction(Request $request)
    {
        $Langue = new Langues();
        $form = $this->createForm(LanguesFormType::class, $Langue);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Langue->addUser($modeles);


                $em->persist($Langue);
                $em->persist($Langue);
                $em->flush();
                $this->addFlash("success", "Langues Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/langmodifaddcandi.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/langmodifaddcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deletelanguecandi/{id}", name="deletelanguecandi")
     */
    public function DeletLangueAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Langues::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Langues supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/updateLanguecandi/{id}", name="updateLanguecandi")
     */

    public function editLangueAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Langues::class)->find($id);
        $form = $this->createForm(LanguesFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Langues  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/LangueModifcandi.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/AddrefModifcandi", name="AddrefModifcandi")
     */
    public function AddrefModifAction(Request $request)
    {
        $Ref = new Reference();
        $form = $this->createForm(RefFormType::class, $Ref);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($this->getUser()->getId());

                $Ref->addUser($modeles);


                $em->persist($Ref);
                $em->persist($Ref);
                $em->flush();
                $this->addFlash("success", "Reference Ajouté avec success");

                return $this->redirectToRoute('updatecandiself');

            } else return $this->render('default/refmodifaddcandi.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/refmodifaddcandi.html.twig', array('form' => $form->createView()));
    }
    /**
     * @Route("/deleterefcandi/{id}", name="deleterefcandi")
     */
    public function DeletrefAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Reference::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Reference supprimé avec success");

        return $this->redirectToRoute('updatecandiself');
    }
    /**
     * @Route("/updatrefcandi/{id}", name="updatrefcandi")
     */

    public function editrefAction(Request $request,$id)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Reference::class)->find($id);
        $form = $this->createForm(RefFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Reference  avec success");

            return $this->redirectToRoute('updatecandiself');



        } else return $this->render('default/refModifcandi.html.twig', array('form' => $form->createView()));
    }




}
