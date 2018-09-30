<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 20/08/17
 * Time: 09:45 م
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;
use test\testBundle\Form\OffreType;


class GestionoffreuserController extends Controller
{ // afficher les offre pour le user society
    public function indexAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(Offre::class)->findAll();

        return $this->render('testtestBundle:Default:affichoffreuser.html.twig', array('modeles' => $modeles));


    }


}