<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 10/08/17
 * Time: 01:51 م
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;


class GestionadofController extends Controller
{
    //affichage liste ds offres pour l 'admin
    public function indexAction()

    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(Offre::class)->findAll();

        return $this->render('testtestBundle:Default:listeoffre.html.twig', array('modeles' => $modeles));
    }

    //delete des offres de l 'admin

    public function deleteAction(Request $request, $id)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Offre::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "offre supprimé avec success");

        return $this->redirectToRoute('listeoffre1');

    }

    //affichage liste des offres cherché par l 'admin

    public function rechercheAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Offre::class)->findAll();

        $resut = [];
        if ($request->isMethod("POST")) {
            $typec = $request->get('titre');
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery("SELECT u FROM testtestBundle:Offre u WHERE u.titre =:pay")
                ->setParameter('pay', $typec);
            $resut = $query->getResult();
        }
        return $this->render('testtestBundle:Default:rechercheoffre.html.twig', array('modeles' => $resut));


    }

    //activer une offre par l 'admin

    public function activeAction(Request $request, $id)

    {

        $resut = [];


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testtestBundle:Offre u SET u.active=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 1)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Offre::class)->findAll();

        $this->addFlash("success", "offre activé avec success");

        return $this->render('testtestBundle:Default:listeoffre.html.twig', array('modeles' => $modeles1));


    }

    //desactiver une offre par l 'admin

    public function desactiveAction(Request $request, $id)

    {

        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testtestBundle:Offre u SET u.active=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 0)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Offre::class)->findAll();

        $this->addFlash("success", "offre desactivé avec success");

        return $this->render('testtestBundle:Default:listeoffre.html.twig', array('modeles' => $modeles1));


    }


}