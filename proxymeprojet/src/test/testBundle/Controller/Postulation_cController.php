<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 24/08/17
 * Time: 10:33 ص
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

class Postulation_cController extends Controller

{
    public function indexAction()
    {
        $em1 = $this->getDoctrine()->getManager();


        $modeles = $em1->getRepository(Postulation::class)->findAll();

        return $this->render('testtestBundle:Default:desplay_view_postulation.html.twig', array('modeles' => $modeles));
    }

    public function accepterAction(Request $request, $id)
    {
        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testtestBundle:Postulation u SET u.etat=:pay WHERE u.id =:pay2")
            ->setParameter('pay', "accepte")->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Postulation::class)->findAll();

        $this->addFlash("success", "Postulation accepté avec success");

        return $this->render('testtestBundle:Default:desplay_view_postulation.html.twig', array('modeles' => $modeles1));
    }

    public function refuserAction(Request $request, $id)
    {
        $resut = [];

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("UPDATE testtestBundle:Postulation u SET u.etat=:pay WHERE u.id =:pay2")
            ->setParameter('pay', "refuser")->setParameter('pay2', $id);
        $resut = $query->getResult();
        $em1 = $this->getDoctrine()->getManager();
        $modeles1 = $em1->getRepository(Postulation::class)->findAll();

        $this->addFlash("success", "Postulation refusée");

        return $this->render('testtestBundle:Default:desplay_view_postulation.html.twig', array('modeles' => $modeles1));
    }

    public function ajout_rendezAction(Request $request, $user, $offre)
    {


        $rendez = new Rendez_vous();

        $form = $this->createForm(Rendez_vousType::class, $rendez);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offrea = $em->getRepository(Offre::class)->find($offre);
            $userare = $em->getRepository(User::class)->find($user);

            $usercon = $this->getUser();
            $rendez->setUsersoc($usercon);
            $rendez->setOffre($offrea);
            $rendez->setUser($userare);

            $em->persist($rendez);
            $em->flush();
            // envoie d'email
            $smtp_host_ip = 'smtp.gmail.com';
            $transport = \Swift_SmtpTransport::newInstance($smtp_host_ip, 465, 'ssl')->setUsername('lahiouel.ahmed94@gmail.com')->setPassword('pcwvmegjhriimydm');
            //création d'un objet mailer
            $mailer = \Swift_Mailer::newInstance($transport);
            $email_destinataire = $userare->getEmail();
            $nom_destinataire = $userare->getUsername();
            $poste_recrutement = $offrea->getTitre();
            $user_recruteur = $usercon->getUsername();
            $result = $rendez->getDate();
            $date = $result->format('Y-m-d H:i');
            $email_recruteur = $usercon->getEmail();
            $nom_recruteur = $usercon->getUsername();

            $message = \Swift_Message::newInstance()
                ->setFrom(array($email_recruteur => $nom_recruteur))
                ->setTo(array($email_destinataire => $nom_destinataire));
            $message->setSubject("Fixer Rendez Vous Entretien ");

            $message->setBody('Madame/Mademoiselle/Monsieur ' . $nom_destinataire . '</h1> <br>
<p>Votre candidature au poste ' . $poste_recrutement . ' au sein de notre société a retenu toute notre attention et nous souhaiterions vous rencontrer. Nous vous proposons un entretien avec Mme/M ' . $user_recruteur . ' le ' . $date . ' dans nos locaux situés au Technopole de Sousse BP 184, Sousse Khezama 4051, Tunisie. Nous vous prions de bien vouloir nous confirmer votre présence à ce rendez-vous par email
Dans l’attente de vous rencontrer.</p>', 'text/html');

            $mailer->send($message);
            $modeles = $em->getRepository(Rendez_vous::class)->findAll();

            $this->addFlash("success", "Rendez vous Ajouté avec success et un email est envoyé au destinataire ");
            return $this->render('testtestBundle:Default:desplay_view_rendezvous.html.twig', array('modeles' => $modeles));

//envoie d'email
        } else return $this->render('testtestBundle:Default:ajoutrendez.html.twig', array('form' => $form->createView()));
    }

    public function desplay_rendez_vousAction()
    {
        $usercon = $this->getUser();
        $id_user_connecte = $usercon->getId();
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository(Rendez_vous::class)->findBy((array('usersoc' => $id_user_connecte)));

        return $this->render('testtestBundle:Default:desplay_view_rendezvous.html.twig', array('modeles' => $modeles));
    }

    public function delete_rendez_vousAction(Request $request, $id, $user, $offre)

    {
        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Rendez_vous::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $em = $this->getDoctrine()->getManager();
        $offrea = $em->getRepository(Offre::class)->find($offre);
        $userare = $em->getRepository(User::class)->find($user);

        $usercon = $this->getUser();
// envoie d'email
        $smtp_host_ip = 'smtp.gmail.com';
        $transport = \Swift_SmtpTransport::newInstance($smtp_host_ip, 465, 'ssl')->setUsername('lahiouel.ahmed94@gmail.com')->setPassword('pcwvmegjhriimydm');
        //création d'un objet mailer
        $mailer = \Swift_Mailer::newInstance($transport);
        $email_destinataire = $userare->getEmail();
        $nom_destinataire = $userare->getUsername();
        $email_recruteur = $usercon->getEmail();
        $nom_recruteur = $usercon->getUsername();

        $message = \Swift_Message::newInstance()
            ->setFrom(array($email_recruteur => $nom_recruteur))
            ->setTo(array($email_destinataire => $nom_destinataire));
        $message->setSubject("Annulation du Rendez Vous Entretien ");

        $message->setBody('Madame/Mademoiselle/Monsieur ' . $nom_destinataire . '</h1> <br>
<p> le Rendez vous quand a fixé deja est annulé pour des raison  qui nous concerne on vous contactera plus tard </p>', 'text/html');

        $mailer->send($message);

        $this->addFlash("success", "Rendez Vous supprimé  et mail envoyé avec success  ");

        return $this->redirectToRoute('desplay_rendez_vous');

    }

    public function update_rendez_vousAction(Request $request, $id, $user, $offre)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Rendez_vous::class)->find($id);
        $form = $this->createForm(Rendez_vousType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $offrea = $em->getRepository(Offre::class)->find($offre);
            $userare = $em->getRepository(User::class)->find($user);
            $usercon = $this->getUser();
            $email_recruteur = $usercon->getEmail();

            $em->persist($modeles);
            $em->flush();
            $smtp_host_ip = 'smtp.gmail.com';
            $transport = \Swift_SmtpTransport::newInstance($smtp_host_ip, 465, 'ssl')->setUsername('lahiouel.ahmed94@gmail.com')->setPassword('pcwvmegjhriimydm');
            //création d'un objet mailer
            $mailer = \Swift_Mailer::newInstance($transport);
            $email_destinataire = $userare->getEmail();
            $nom_destinataire = $userare->getUsername();
            $poste_recrutement = $offrea->getTitre();
            $user_recruteur = $usercon->getUsername();
            $result = $modeles->getDate();
            $date = $result->format('Y-m-d H:i');
            $email_recruteur = $usercon->getEmail();
            $nom_recruteur = $usercon->getUsername();

            $message = \Swift_Message::newInstance()
                ->setFrom(array($email_recruteur => $nom_recruteur))
                ->setTo(array($email_destinataire => $nom_destinataire));
            $message->setSubject("Mise A Jour Rendez Vous Entretien ");

            $message->setBody('Madame/Mademoiselle/Monsieur ' . $nom_destinataire . '</h1> <br>
<p> Nous vous proposons un autre date pour  l entretien  fixé avec Mme/M ' . $user_recruteur . ' pour le ' . $date . ' dans nos locaux situés au Technopole de Sousse BP 184, Sousse Khezama 4051, Tunisie. Nous vous prions de bien vouloir nous confirmer votre présence à ce rendez-vous par email
Dans l’attente de vous rencontrer.</p>', 'text/html');

            $mailer->send($message);
            $modeles = $em->getRepository(Rendez_vous::class)->findAll();
            $this->addFlash("success", "mise a jour du rendez vous et l'envoi d'email effectué avec success !!");


            return $this->render('testtestBundle:Default:desplay_view_rendezvous.html.twig', array('modeles' => $modeles));


        } else return $this->render('testtestBundle:Default:ajoutrendez.html.twig', array('form' => $form->createView()));
    }

    public function view_postulationAction()
    {
        $em1 = $this->getDoctrine()->getManager();
        $usercon = $this->getUser();
        $id_user_connecte = $usercon->getId();


        $modeles = $em1->getRepository(Postulation::class)->findBy((array('user' => $id_user_connecte)));

        return $this->render('testtestBundle:Default:desplay_view_postulation_candidat.html.twig', array('modeles' => $modeles));
    }


}