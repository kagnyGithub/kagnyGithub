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

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
   public function login(){
        return $this->render('security/pageConnexion.html.twig',[
            
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
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user=new Users();
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
            'formRegistre' => $form->createView()
        ]);
    }

    /**
    * @Route("/espaceMembre", name="espace_membre")
    */
    public function espaceMembre(CategoriesRepository $repoCategorie, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        
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
            'user' =>$user
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
        $user=$user->findBy(['id'=>$id]);
        return $this->render('security/mail.html.twig',[
            'categories' => $categorie,
            'email' =>$user[0]->getEmail()
        ]);
    }

}
