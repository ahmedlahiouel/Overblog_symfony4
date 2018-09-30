<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 25/08/17
 * Time: 01:55 م
 */

namespace test\testBundle\Controller;

use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use test\testBundle\Entity\Offre;
use test\testBundle\Entity\Postulation;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Rendez_vous;
use test\testBundle\Form\Rendez_vousType;
use test\userBundle\Entity\User;
use \Datetime;


class Rendez_vous_cController extends Controller
{
    public function view_rendez_userAction()
    {
        $usercon = $this->getUser();
        $id_user_connecte = $usercon->getId();
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository(Rendez_vous::class)->findBy((array('user' => $id_user_connecte)));
        return $this->render('testtestBundle:Default:desplay_view_rendez_vous_candidat.html.twig', array('modeles' => $modeles));


    }


}