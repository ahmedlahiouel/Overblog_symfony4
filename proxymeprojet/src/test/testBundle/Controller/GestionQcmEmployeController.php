<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 28/08/17
 * Time: 08:43 ص
 */

namespace test\testBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use test\testBundle\Entity\Offre;
use test\testBundle\Entity\Postulation;
use test\testBundle\Entity\Question;
use Symfony\Component\HttpFoundation\Response;
use test\testBundle\Entity\Qcm;


class GestionQcmEmployeController extends Controller
{

    public function show_QCM_OffreAction(Request $request, $idoffre, $idqcm)
// afficher le Qcm d'un offre bin determiner
    {

        $em1 = $this->getDoctrine()->getManager();
        $offre = $em1->getRepository(Offre::class)->find($idoffre);
// creation de l'objet postuation
        $post = new Postulation();
        $post->setUser($this->getUser());
        $post->setOffre($offre);
        $date = new \DateTime();
        $post->setDatepost($date);
        $post->setEtat('en attente');
        $post->setNoteQcmRecu(0);
        $em1->persist($post);
        $em1->flush();
        // recuperer l'id du dernier postulation
        $query = $em1->createQuery("SELECT u FROM testtestBundle:Postulation u WHERE u.datepost =:var1 and u.user=:var2")
            ->setParameter('var1', $date)->setParameter('var2', $this->getUser());

        $resut = $query->getResult();

        foreach ($resut as $even) {
            $idpostule = ($even->getId());
        }
// recuperer les question de ce qcm
        $questions = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:Question', 'p')
            ->join('p.Qcm', 'q')
            ->where('q.id = :qcmid')
            ->setParameter('qcmid', $idqcm)
            ->getQuery()
            ->getResult();
// pour chaque question generer ces reponses
        foreach ($questions as $event) {
            $id = $event->getId();
            $enance = $event->getEnance();
        }

        array_pop($questions);

        return $this->show_QCM_repAction($questions, $id, $enance, $idpostule);

    }

    public function intermidiaireAction(Request $request)
    {


        $idr = $request->request->get('postule');
        $idpostule = intval($idr);
        $str = $request->request->get('nouvquest');
        $idquest = $str[0];


        $em1 = $this->getDoctrine()->getManager();
        $modeles = $em1->getRepository(Question::class)->find($idquest);

        $id = $modeles->getId();
        $enance = $modeles->getEnance();

        array_shift($str);
        return $this->show_QCM_repAction2($str, $id, $enance, $idpostule);


    }


    public function show_QCM_repAction($array, $idquestion, $enance, $idpostule)
    {
        // dump($array);
        $em1 = $this->getDoctrine()->getManager();
        $reponses = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:reponse', 'p')
            ->join('p.question', 'q')
            ->where('q.id = :questid')
            ->setParameter('questid', $idquestion)
            ->getQuery()
            ->getResult();
        $modeles = $em1->getRepository(Question::class)->find($idquestion);
        $reponsesexacte = $modeles->getReponsecorrect()->getEnance();


        return $this->render('testtestBundle:Default:affichQcmInterface.html.twig', array('modeles' => $reponses, 'enance' => $enance, 'reponse' => $reponsesexacte, 'postule' => $idpostule, 'nouv' => $array, 'idquestion' => $idquestion));


    }

    public function show_QCM_repAction2($array, $idquestion, $enance, $idpostule)
    {
        $em1 = $this->getDoctrine()->getManager();
        $reponses = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:reponse', 'p')
            ->join('p.question', 'q')
            ->where('q.id = :questid')
            ->setParameter('questid', $idquestion)
            ->getQuery()
            ->getResult();
        $modeles = $em1->getRepository(Question::class)->find($idquestion);
        $reponsesexacte = $modeles->getReponsecorrect()->getEnance();
        $data = $this->render('testtestBundle:Default:retourner.html.twig', array('modeles' => $reponses, 'enance' => $enance, 'reponse' => $reponsesexacte, 'postule' => $idpostule, 'nouv' => $array, 'idquestion' => $idquestion));
        $html = $data->getContent();
        $jsonArray = array(
            'data' => $html,
        );
        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;

    }


    public function incrementAction(Request $request)
    {
// recuperer l id du postulation et ecrementé le nombre par 1 si la resultat est valide
        $em1 = $this->getDoctrine()->getManager();
        $idqcm = $request->request->get('postule');
        $id = intval($idqcm);
        $idquest = $request->request->get('question');
        $idqu = intval($idquest);
        $valeur = $request->request->get('value');

        $modeles = $em1->getRepository(Question::class)->find($idqu);
        $reponsesexacte = $modeles->getReponsecorrect()->getEnance();

        if ($valeur == $reponsesexacte) {
            $modeles = $em1->getRepository(Postulation::class)->find($id);

            $modeles->setNoteQcmRecu($modeles->getNoteQcmRecu() + 1);
            $em1->persist($modeles);
            $em1->flush();
        }

        $usercon = $this->getUser();
        $id_user_connecte = $usercon->getId();


        $modeles = $em1->getRepository(Postulation::class)->findBy((array('user' => $id_user_connecte)));

        return $this->render('testtestBundle:Default:desplay_view_postulation_candidat.html.twig', array('modeles' => $modeles));


    }

    public function resultatqcmAction(Request $request)
    {
        $em1 = $this->getDoctrine()->getManager();
        $idqcm = $request->request->get('postule');
        $id = intval($idqcm);

        $modeles = $em1->getRepository(Postulation::class)->find($id);
        $noterecu = $modeles->getNoteQcmRecu();
        $offre = $modeles->getOffre();
        $qcm = $offre->getQcm();
        $idq = $qcm->getId();


        $qb = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:Question', 'p')
            ->join('p.Qcm', 'q')
            ->where('q.id = :qcmid')
            ->setParameter('qcmid', $idq)
            ->getQuery()
            ->getResult();
        $Qcm1 = $em1->getRepository(Qcm::class)->find($idq);


        $data = $this->render('testtestBundle:Default:affichres.html.twig', array('modeles' => $qb, 'enance' => $Qcm1->getEnance(), 'note' => $Qcm1->getNoteAccepter(), 'resultat' => $noterecu));

        $html = $data->getContent();
        $jsonArray = array(
            'data' => $html,
        );
        $response = new Response(json_encode($jsonArray));
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');

        return $response;

    }


}