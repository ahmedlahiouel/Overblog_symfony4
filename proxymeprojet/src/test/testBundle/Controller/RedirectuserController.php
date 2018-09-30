<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 14/08/17
 * Time: 01:56 م
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;
use test\testBundle\Form\OffreType;


class RedirectuserController extends Controller
{ // redirection page admin
    public function homeAction(Request $request)

    {


        return $this->render('testtestBundle:Default:interfacehome.html.twig');
    }

// redirection page societe selon le role
    public function societeAction()

    {


        return $this->render('testtestBundle:Default:interfacehomesociete.html.twig');
    }

// redirection page simple utilisateur
    public function personneAction()

    {


        return $this->render('testtestBundle:Default:interfacehomepers.html.twig');
    }


}
