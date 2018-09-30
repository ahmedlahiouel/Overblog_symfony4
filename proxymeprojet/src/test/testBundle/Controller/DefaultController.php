<?php

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('testtestBundle:Default:index.html.twig');
    }
}
