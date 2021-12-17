<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\CategoriesRepository;
use App\Repository\UsersRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
   public function login(CategoriesRepository $repoCategorie){
        $categorie=$repoCategorie->findAll();
        return $this->render('security/pageConnexion.html.twig',[
            'categories' => $categorie
        ]);
   }
   
    /**
    * @Route("/deconnexion", name="security_logout")
    */
   public function logout(){
       return $this->render('biblio/home.html.twig');
   }


    /**
     * @Route("/inscription", name= "security_registration")
     */
    public function registration(CategoriesRepository $repoCategorie, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user=new Users();
        $categorie=$repoCategorie->findAll();
        $form=$this->createForm(UsersFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user , $user->getPassword());
            $user->setNbrePoint(0);
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
             return $this->redirectToRoute('security_registration');
        }
        return $this->render('security/Registration.html.twig',[
            'formRegistre' => $form->createView(),
            'categories' => $categorie
        ]);
    }

    /**
    * @Route("/espaceMembre", name="espace_membre")
    */
    public function espaceMembre(CategoriesRepository $repoCategorie, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $user1 = $this->getUser();
        $categorie=$repoCategorie->findAll();
        $user=new Users();
        $form=$this->createForm(UsersFormType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            
        }
        return $this->render('bibliotroc/espaceMembre.html.twig',[
            'formRegistre' => $form->createView(),
            'categories' => $categorie,
            'user' =>$user,
            'points'=>$user1->getNbrePoint()
        ]);
    }

    /**
     * @Route("/connecter", name="connecter")
     */
    public function connecter(CategoriesRepository $repoCategorie){
        $categorie=$repoCategorie->findAll();
        return $this->render('security/pageConnexion.html.twig',[
            'categories' => $categorie
        ]);
    }

    /**
     * @Route("/Email/{id}", name="Email")
     */
    public function Email($id, CategoriesRepository $repoCategorie, UsersRepository $user){
        $categorie=$repoCategorie->findAll();
        $userMail=$user->findBy(['id'=>$id]);
        return $this->render('security/mail.html.twig',[
            'categories' => $categorie,
            'email' =>$userMail[0]->getEmail()
        ]);
    }

    /**
    * @Route("/sendMail", name="sendMail")
    */
   public function sendMail(MailerInterface $mailer ,Request $request)
   {
    $fperson=$request->request->get('email');
    $contenu=$request->request->get('message');
    $user1 = $this->getUser();
      $mail = (new Email())
         ->from($user1->getEmail())
         ->to($fperson)
         ->subject('Mon beau sujet')
         ->html($contenu)
      ;

      $mailer->send($mail);

   }

}
