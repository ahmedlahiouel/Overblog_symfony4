<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 23/08/17
 * Time: 10:34 ص
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;

class UsercontController extends Controller
{
    public function showAction()

    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(Offre::class)->findAll();

        return $this->render('testtestBundle:Default:affich_offre_de_post.html.twig', array('modeles' => $modeles));
    }


}



