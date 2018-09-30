<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Reponse;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\Serializer\Serializer;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/gestionuser", name="gestionuser")
     */
    public function userAction()
//afficher liste des user pour l admin
    {
        $us = $this->getUser();
        $id = $us->getId();
        $resut = [];
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT u FROM App:User u WHERE u.id <>:rol  ")
            ->setParameter('rol', $id);;
        $resut = $query->getResult();

        return $this->render('default/admin.html.twig', array('modeles' => $resut));
    }

    /**
     * @Route("/deleteuser/{id}", name="deleteuser")
     */
    public function deleteAction(Request $request, $id)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "User supprimé avec success");

        return $this->redirectToRoute('gestionuser');
    }

    /**
     * @Route("/rechuser", name="rechuser")
     */

    public function rechercheAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(User::class)->findAll();
        $us = $this->getUser();
        $id = $us->getId();

        $resut = [];
        if ($request->isMethod("POST")) {
            $typec = $request->get('nom');
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery("SELECT u FROM App:User u WHERE u.username =:pay and u.id <>:rol ")
                ->setParameter('pay', $typec)
                ->setParameter('rol', $id);;
            $resut = $query->getResult();
        }
        return $this->render('default/rechuser.html.twig', array('modeles' => $resut));


    }

    /**
     * @Route("/Active/{id}", name="Active")
     */
    public function ActiveAction(Request $request, $id)

    {
        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE App:User u SET u.enabled=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 1)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $this->addFlash("success", "user activé avec success");


        return $this->userAction();

    }

    /**
     * @Route("/Desactive/{id}", name="Desactive")
     */
    public function DesActiveAction(Request $request, $id)

    {
        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE App:User u SET u.enabled=:pay WHERE u.id =:pay2")
            ->setParameter('pay', 0)->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $this->addFlash("success", "user activé avec success");


        return $this->userAction();

    }

    /**
     * @Route("Affich/{id}", name="Affich")
     */
    public function ProfilAction(Request $request, $id)

    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()->select('p')
            ->from('App:Cursus', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb2 = $em->createQueryBuilder()->select('p')
            ->from('App:Stages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb3 = $em->createQueryBuilder()->select('p')
            ->from('App:Emplois', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb4 = $em->createQueryBuilder()->select('p')
            ->from('App:Avantages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb5 = $em->createQueryBuilder()->select('p')
            ->from('App:Langues', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb6 = $em->createQueryBuilder()->select('p')
            ->from('App:Reference', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb7 = $em->createQueryBuilder()->select('p')
            ->from('App:Reponse', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($id);


        $temp = $this->render('default/affichprofil.html.twig', array('modeles' => $modeles, 'modeles2' => $qb, 'stages' => $qb2, 'listeemplois' => $qb3, 'listeavantages' => $qb4, 'listelangues' => $qb5, 'listereference' => $qb6,'reponses'=>$qb7));
        return $temp;

    }

    /**
     * @Route("Pdf/{id}", name="Pdf")
     */
    public function genpdfAction(Request $request, $id)

    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()->select('p')
            ->from('App:Cursus', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb2 = $em->createQueryBuilder()->select('p')
            ->from('App:Stages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb3 = $em->createQueryBuilder()->select('p')
            ->from('App:Emplois', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb4 = $em->createQueryBuilder()->select('p')
            ->from('App:Avantages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb5 = $em->createQueryBuilder()->select('p')
            ->from('App:Langues', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb6 = $em->createQueryBuilder()->select('p')
            ->from('App:Reference', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($id);


        $temp = $this->render('default/pdf.html.twig', array('modeles' => $modeles, 'modeles2' => $qb, 'stages' => $qb2, 'listeemplois' => $qb3, 'listeavantages' => $qb4, 'listelangues' => $qb5, 'listereference' => $qb6,));
        $htmltopdf = $this->get('app.html2pdf');
        $htmltopdf->create('P', 'A4', 'fr', true, 'UTF-8', array(10, 15, 10, 15));
        return $htmltopdf->generatepdf($temp,$modeles->getUserName().'_'.$modeles->getPrenom());


    }


    /**
     * @Route("Questionexp", name="Questionexp")
     */
    public function QuestionExpAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();


       $expersquestion = $em1->getRepository(Questions::class)->findBy(array('type' => 'Expérience Professionnelle'));
        foreach ($expersquestion as $event) {
            $id = $event->getId();
            $enance = $event->getEnance();
        }

        array_pop($expersquestion);
//        $serializer = new Serializer([new ObjectNormalizer()]);
//        $result = $serializer->normalize($newspapers);
        return $this->render('default/questionexperience.html.twig', array('enance' => $enance,'nouv' => $expersquestion,'id'=>$id));

    }

    /**
     * @Route("/vasi", name="vasi")
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
     * @Route("/addreponseexper", name="addreponseexper")
     * @method('POST')
     */
    public function addrepexperAction(Request $request)

    {

        $em1 = $this->getDoctrine()->getManager();
        $idquest = $request->request->get('question');
        $idqu = intval($idquest);
        $valeur = $request->request->get('value');
        $qust = $em1->getRepository(Questions::class)->find($idqu);
        $rep=new Reponse();
$rep->setRep($valeur);
$rep->addUser( $this->getUser());
$rep->addQuestions($qust);
$em1->persist($rep);
$em1->flush();






        return new JsonResponse(['succes'=>true]);

    }
    /**
     * @Route("pas", name="pas")
     */
    public function intermidiaireAction(Request $request)
    {

$tab=[];
        $str = $request->request->get('nouvquest');

        $idquest = $str[0];
        $idqu = intval($idquest);


        $em1 = $this->getDoctrine()->getManager();
        $modeles = $em1->getRepository(Questions::class)->find($idqu);
        $i = $modeles->getId();


        $enance = $modeles->getEnance();
        array_shift($str);
for ($i=0;$i<count($str);$i++)
{
    $idquest = $str[$i];
    $idqu = intval($idquest);


    $em1 = $this->getDoctrine()->getManager();
    $modeles = $em1->getRepository(Questions::class)->find($idqu);
    array_push($tab, $modeles);

}
        $data=   $this->render('default/questionexper.html.twig',array('enance' => $enance,'nouv' => $tab,'id'=>$i));
        $html = $data->getContent();
        $jsonArray = array(
            'data' => $html,
        );
        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;


    }


    /**
     * @Route("QuestionRech", name="QuestionRech")
     */
    public function QuestionAction(Request $request)

    {
        $em1 = $this->getDoctrine()->getManager();


        $expersquestion = $em1->getRepository(Questions::class)->findBy(array('type' => 'Recherche emploi'));
        foreach ($expersquestion as $event) {
            $id = $event->getId();
            $enance = $event->getEnance();
        }

        array_pop($expersquestion);

        $data=   $this->render('default/questionrech.html.twig',array('enance' => $enance,'nouv' => $expersquestion,'id'=>$id));
        $html = $data->getContent();
        $jsonArray = array(
            'data' => $html,
        );
        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;

    }

    /**
     * @Route("pasrech", name="pasrech")
     */
    public function intermidiairerechAction(Request $request)
    {

        $tab=[];
        $str = $request->request->get('nouvquest');

        $idquest = $str[0];
        $idqu = intval($idquest);


        $em1 = $this->getDoctrine()->getManager();
        $modeles = $em1->getRepository(Questions::class)->find($idqu);
        $i = $modeles->getId();


        $enance = $modeles->getEnance();
        array_shift($str);
        for ($i=0;$i<count($str);$i++)
        {
            $idquest = $str[$i];
            $idqu = intval($idquest);


            $em1 = $this->getDoctrine()->getManager();
            $modeles = $em1->getRepository(Questions::class)->find($idqu);
            array_push($tab, $modeles);

        }
        $data=   $this->render('default/questionrech.html.twig',array('enance' => $enance,'nouv' => $tab,'id'=>$i));
        $html = $data->getContent();
        $jsonArray = array(
            'data' => $html,
        );
        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;


    }
    /**
     * @Route("addreponserech", name="addreponserech")
     * @method('POST')
     */
    public function addrepAction(Request $request)

    {

        $em1 = $this->getDoctrine()->getManager();
        $idquest = $request->request->get('question');
        $idqu = intval($idquest);
        $valeur = $request->request->get('value');
        $qust = $em1->getRepository(Questions::class)->find($idqu);
        $rep=new Reponse();
        $rep->setRep($valeur);
        $rep->addUser( $this->getUser());
        $rep->addQuestions($qust);
        $em1->persist($rep);
        $em1->flush();






        return new JsonResponse(['succes'=>true]);

    }

    /**
     * @Route("Word/{id}", name="Word")
     */
    public function genWordAction(Request $request, $id)

    {
        $em = $this->getDoctrine()->getManager();

        $qb = $em->createQueryBuilder()->select('p')
            ->from('App:Cursus', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb2 = $em->createQueryBuilder()->select('p')
            ->from('App:Stages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb3 = $em->createQueryBuilder()->select('p')
            ->from('App:Emplois', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb4 = $em->createQueryBuilder()->select('p')
            ->from('App:Avantages', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb5 = $em->createQueryBuilder()->select('p')
            ->from('App:Langues', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $qb6 = $em->createQueryBuilder()->select('p')
            ->from('App:Reference', 'p')
            ->join('p.user', 'q')
            ->where('q.id = :userid')
            ->setParameter('userid', $id)
            ->getQuery()
            ->getResult();
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(User::class)->find($id);
        $template= $this->renderView('/default/word.html.twig', array('modeles' => $modeles, 'modeles2' => $qb, 'stages' => $qb2, 'listeemplois' => $qb3, 'listeavantages' => $qb4, 'listelangues' => $qb5, 'listereference' => $qb6,));


        $htmltoword = $this->get('app.html2word');
        $htmltoword->generateword($template,$modeles->getUsername());
        return $this->render('/default/word.html.twig', array('modeles' => $modeles, 'modeles2' => $qb, 'stages' => $qb2, 'listeemplois' => $qb3, 'listeavantages' => $qb4, 'listelangues' => $qb5, 'listereference' => $qb6,));
    }

}