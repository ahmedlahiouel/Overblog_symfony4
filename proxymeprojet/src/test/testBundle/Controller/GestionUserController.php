<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 11/08/17
 * Time: 10:31 ص
 */

namespace test\testBundle\Controller;

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\userBundle\Entity\User;


class GestionUserController extends Controller
{
    public function indexAction()
//afficher liste des user pour l admin
    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(User::class)->findAll();

        return $this->render('testtestBundle:Default:listeuser.html.twig', array('modeles' => $modeles));
    }

//supprimer un user
    public function deleteAction(Request $request, $id)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "User supprimé avec success");

        return $this->redirectToRoute('listeuser');
    }

//activer un user
    public function activeAction(Request $request, $id)

    {

        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testuserBundle:User u SET u.enabled=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 1)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(User::class)->findAll();
        $this->addFlash("success", "user activé avec success");


        return $this->render('testtestBundle:Default:listeuser.html.twig', array('modeles' => $modeles1));


    }

// desactiver un user
    public function desactiveAction(Request $request, $id)

    {

        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testuserBundle:USER u SET u.enabled=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 0)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(User::class)->findAll();
        $this->addFlash("success", "user desactivé avec success");


        return $this->render('testtestBundle:Default:listeuser.html.twig', array('modeles' => $modeles1));


    }

// rechercher un user
    public function rechercheAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(User::class)->findAll();

        $resut = [];
        if ($request->isMethod("POST")) {
            $typec = $request->get('nom');
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery("SELECT u FROM testuserBundle:User u WHERE u.username =:pay")
                ->setParameter('pay', $typec);
            $resut = $query->getResult();
        }
        return $this->render('testtestBundle:Default:rechercheuser.html.twig', array('modeles' => $resut));


    }

// acitiver l'option admin pour le user
    public function activeadmineAction(Request $request, $id)

    {
        $em = $this->getDoctrine()->getManager();

        // Search for the UserEntity, retrieve the repository
        $modeles1 = $em->getRepository(User::class)->find($id);
        // or $userRepository = $em->getRepository("myBundle:User");


        // Add the role that you want !
        $modeles1->addRole("ROLE_ADMIN");

        // Save changes in the database
        $em->persist($modeles1);
        $em->flush();
        $em = $this->getDoctrine()->getManager();

        // Search for the UserEntity, retrieve the repository
        $modeles = $em->getRepository(User::class)->findAll();

        $this->addFlash("success", "user activé admin avec success");

        return $this->render('testtestBundle:Default:listeuser.html.twig', array('modeles' => $modeles));


    }


}
