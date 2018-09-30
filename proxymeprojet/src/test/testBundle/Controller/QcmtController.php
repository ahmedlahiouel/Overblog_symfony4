<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 10/08/17
 * Time: 11:53 ص
 */

namespace test\testBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use test\testBundle\Entity\Qcm;
use test\testBundle\Entity\Question;
use test\testBundle\Form\QcmType;
use test\testBundle\Entity\reponse;

class QcmtController extends Controller
{
    public function indexAction()

    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(Qcm::class)->findAll();

        return $this->render('testtestBundle:Default:afficheqcm.html.twig', array('modeles' => $modeles));
    }

    public function rechercheadminqcmAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Qcm::class)->findAll();

        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT u FROM testtestBundle:Qcm u WHERE u.id =:pay")
            ->setParameter('pay', $id);
        $resut = $query->getResult();

        return $this->render('testtestBundle:Default:afficheqcm.html.twig', array('modeles' => $resut));

    }

    public function desplayformqcmAction(Request $request)
    {


        return $this->render('testtestBundle:Default:ajoutqcm.html.twig');

    }

    public function supprimeAction(Request $request, $id)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Qcm::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Qcm supprimé avec success");

        return $this->redirectToRoute('affichqcmsoc');

    }

    public function miseAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Qcm::class)->find($id);
        $form = $this->createForm(QcmType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $modeles = $em->getRepository(Qcm::class)->findAll();
            $this->addFlash("success", "mise a jour de Qcm  avec success");


            return $this->render('testtestBundle:Default:afficheqcm.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:updateQcm.html.twig', array('form' => $form->createView()));
    }

    public function getFilteredListAction(Request $request)
    {

        $idqcm = $request->request->get('numbreqcm');
        $id = intval($idqcm);
        $enanc = $request->request->get('enance');
        $nombre = $request->request->get('numberpasse');
        $em1 = $this->getDoctrine()->getManager();
        $Qcm1 = new Qcm();
        $Qcm1->setId($id);
        $Qcm1->setEnance($enanc);
        $Qcm1->setNoteAccepter($nombre);

        $em1->persist($Qcm1);
        $em1->flush();

        return $this->redirectToRoute('affichqcmsoc');


    }

    public function setquestionqcmAction(Request $request)
    {

        $idqcm = $request->request->get('numbreqcm');
        $id = intval($idqcm);
        $em1 = $this->getDoctrine()->getManager();
        $Qcm1 = $em1->getRepository(Qcm::class)->find($id);
        $enanc = $request->request->get('enance');
        $rep1 = $request->request->get('repp1');
        $rep2 = $request->request->get('repp2');
        $rep3 = $request->request->get('repp3');
        $rep4 = $request->request->get('reppcorect');
        $reponse = new reponse();
        $reponse->setEnance($rep4);
        $em1->persist($reponse);
        $em1->flush();
        $repo = $em1->getRepository(reponse::class)->findOneBy(["enance" => $rep4]);
        $quest = new Question();
        $quest->setEnance($enanc);
        $quest->addQcm($Qcm1);
        $quest->setReponsecorrect($repo);

        $em1->persist($quest);
        $em1->flush();
        $reponse1 = new reponse();
        $reponse1->setEnance($rep1);
        $reponse1->addQuestion($quest);
        $em1->persist($reponse1);
        $em1->flush();
        $reponse2 = new reponse();
        $reponse2->setEnance($rep2);
        $reponse2->addQuestion($quest);

        $em1->persist($reponse2);
        $em1->flush();
        $reponse3 = new reponse();
        $reponse3->setEnance($rep3);
        $reponse3->addQuestion($quest);

        $em1->persist($reponse3);
        $em1->flush();

        return $this->redirectToRoute('affichqcmsoc');


    }

    public function view_Qcm_backAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $qb = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:Question', 'p')
            ->join('p.Qcm', 'q')
            ->where('q.id = :qcmid')
            ->setParameter('qcmid', $id)
            ->getQuery()
            ->getResult();
        $Qcm1 = $em1->getRepository(Qcm::class)->find($id);


        return $this->render('testtestBundle:Default:testahmed.html.twig', array('modeles' => $qb, 'enance' => $Qcm1->getEnance(), 'note' => $Qcm1->getNoteAccepter()));

    }

    public function view_Qcm_back_socAction(Request $request, $id)
    {

        $em1 = $this->getDoctrine()->getManager();

        $qb = $em1->createQueryBuilder()->select('p')
            ->from('testtestBundle:Question', 'p')
            ->join('p.Qcm', 'q')
            ->where('q.id = :qcmid')
            ->setParameter('qcmid', $id)
            ->getQuery()
            ->getResult();
        $Qcm1 = $em1->getRepository(Qcm::class)->find($id);


        return $this->render('testtestBundle:Default:affich_qcm_soc.html.twig', array('modeles' => $qb, 'enance' => $Qcm1->getEnance(), 'note' => $Qcm1->getNoteAccepter()));

    }


}