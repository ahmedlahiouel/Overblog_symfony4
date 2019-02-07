<?php
/**
 * Created by PhpStorm.
 * User: inesm
 * Date: 15/05/18
 * Time: 14:48
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GraphQLExplorerController extends Controller
{

    /**
     * @Cache(expires="tomorrow", public=true)
     * @Route("/graphql/explorer")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function explorerAction()
    {
        return $this->render('explorer.html.twig', [
            'graphQLUrl' => $this->generateUrl('youshido_graphql_graphql_default'),
            'tokenHeader' => 'Authorization'
        ]);
    }
}
