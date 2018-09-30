<?php

namespace App\Controller;

use App\Entity\Cursus;
use App\Form\ChangePasswordFormType;
use App\Form\CursusFormType;
use App\Form\ProfileFormType;
use App\Form\UpdateUserFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Form\RegistrationType;
use app\Entity\User;

class DefaultController extends Controller
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;

    }


    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/crerrcomptecan", name="crerrcomptecan")
     */
    public function registerAction(Request $request, \Swift_Mailer $mailer)
    {
        $off = new User();
        $form = $this->createForm(RegistrationType::class, $off);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $off->setEnabled(true);
                $off->setSecteur('non idenifié');
                $off->setAdressepersonelle('non idenifié');
                $off->setCin('non idenifié');
                $off->setCite('non idenifié');
                $off->setCodepostal('non idenifié');
                $off->setGouvernorat('non idenifié');
                $off->setLieunaissance('non idenifié');
                $off->setNbenfants('non idenifié');
                $off->setNumcnss('non idenifié');
                $off->setNumtlfixe('non idenifié');
                $off->setPays('non idenifié');
                $off->setRue('non idenifié');
                $off->setSituationfamiliale('non idenifié');
                $off->setVille('non idenifié');
                $off->setEtape('0');
                $off->setNationalite('non identifié');

                $role = $off->getRoles();
                array_push($role, "ROLE_CANDIDAT");

                $off->setRoles($role);
                $pass = $this->generateRandomString(15);
                $newpasshash = $this->passwordEncoder->encodePassword($off, $pass);
                $off->setPassword($newpasshash);
                $message = (new \Swift_Message('Information '))
                    ->setFrom('px.youcoin@gmail.com')
                    ->setTo($off->getEmail())
                    ->setBody(
                        'Madame/Mademoiselle/Monsieur  votre Login pour acceder a votre espace est    ' . '   ' . $off->getUsername() . '   et votre mot de passe est   ' . $pass,
                        'text/html'
                    );
                $mailer->send($message);
                $em->persist($off);
                $em->flush();
                $id = $off->getId();
                $resut = [];
                $login=$off->getUsername();
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery("SELECT u FROM App:User u WHERE u.id <>:rol  ")
                    ->setParameter('rol', $this->getUser()->getId());;
                $resut = $query->getResult();
                $this->addFlash("success", "Candidat Ajouté avec success");

                return $this->redirectToRoute('gestionuser');

            } else return $this->render('views/Registration/register.html.twig', array('form' => $form->createView()));

        } else return $this->render('views/Registration/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/updateuser/{id}", name="updateuser")
     */
    public function updateuserAction(Request $request, $id)

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
        $form = $this->createForm(UpdateUserFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($modeles);
                $em->flush();

                $us = $this->getUser();
                $id = $us->getId();
                $resut = [];
                $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery("SELECT u FROM App:User u WHERE u.id <>:rol  ")
                    ->setParameter('rol', $this->getUser()->getId());;
                $resut = $query->getResult();
                $this->addFlash("success", "mise a jour utilisateur  avec success en attente de verification du admin !!");


                return $this->render('default/admin.html.twig', array('modeles' => $resut));


            } else return $this->render('views/Registration/updateuser.html.twig', array('form' => $form->createView(), 'modeles' => $qb,'listestage'=>$qb2,'listeemplois'=>$qb3,'listeavantages'=>$qb4,'listelangues'=>$qb5,'listereference'=>$qb6, 'idcandidat' => $id));
        } else return $this->render('views/Registration/updateuser.html.twig', array('form' => $form->createView(), 'modeles' => $qb,'listestage'=>$qb2, 'listeemplois'=>$qb3,'listeavantages'=>$qb4,'listelangues'=>$qb5,'listereference'=>$qb6,'idcandidat' => $id));
    }

    function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    /**
     * @Route("/updatadmin", name="updatadmin")
     */

    public function editpersAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        // $formFactory = $this->get('fos_user.profile.form.factory');

        //$form = $formFactory->createForm();
        $form = $this->createForm(ProfileFormType::class, $user);

        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $this->addFlash("success", "Inforamtion Modifié");

                $url = $this->generateUrl('updatadmin');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('views/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/resetpassword", name="resetpassword")
     */
    public function changePasswordsocAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $form = $this->createForm(ChangePasswordFormType::class, $user);

        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {

                $this->addFlash("success", "Password Modifié");

                $url = $this->generateUrl('updatadmin');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::CHANGE_PASSWORD_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('views/ChangePassword/change_password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/Addcursus/{id}", name="Addcursus")
     */
    public function AddcursusAction(Request $request, $id)
    {
        $Cursus = new Cursus();
        $form = $this->createForm(CursusFormType::class, $Cursus);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Cursus->addUser($modeles);


                $em->persist($Cursus);
                $em->persist($Cursus);
                $em->flush();
                $this->addFlash("success", "Cursus Ajouté avec success");

                return $this->redirectToRoute('Addcursus', array('id' => $id));

            } else return $this->render('default/cursus.html.twig', array('form' => $form->createView(),'id'=>$id));

        } else return $this->render('default/cursus.html.twig', array('form' => $form->createView(),'id'=>$id));
    }
    /**
     * @Route("/AddcursusModif/{id}", name="AddcursusModif")
     */
    public function AddcursusModifAction(Request $request, $id)
    {
        $Cursus = new Cursus();
        $form = $this->createForm(CursusFormType::class, $Cursus);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $modeles = $em->getRepository(User::class)->find($id);

                $Cursus->addUser($modeles);


                $em->persist($Cursus);
                $em->persist($Cursus);
                $em->flush();
                $this->addFlash("success", "Cursus Ajouté avec success");

                return $this->redirectToRoute('updateuser', array('id' => $id));

            } else return $this->render('default/cursusmodifadd.html.twig', array('form' => $form->createView()));

        } else return $this->render('default/cursusmodifadd.html.twig', array('form' => $form->createView()));
    }





    /**
     * @Route("/deletecursus/{id}/{idc}", name="deletecursus")
     */
    public function DeletecursusAction(Request $request, $id, $idc)
    {

        $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Cursus::class)->find($id);
        $em1->remove($modeles);
        $em1->flush();
        $this->addFlash("success", "Cursus supprimé avec success");

        return $this->redirectToRoute('updateuser', array('id' => $idc));
    }

    /**
     * @Route("/updatcursus/{id}/{idc}", name="updatcursus")
     */

    public function editcursusAction(Request $request,$id,$idc)
    { $em1 = $this->getDoctrine()->getManager();

        $modeles = $em1->getRepository(Cursus::class)->find($id);
        $form = $this->createForm(CursusFormType::class, $modeles);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modeles);
            $em->flush();

            $this->addFlash("success", "mise a jour de Cursus  avec success");

            return $this->redirectToRoute('updateuser', array('id' => $idc));



        } else return $this->render('default/cursusModif.html.twig', array('form' => $form->createView()));
    }




}
