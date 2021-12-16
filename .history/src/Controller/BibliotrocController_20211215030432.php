<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Entity\Posseder;
use App\Repository\PossederRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BibliotrocController extends AbstractController
{
    /**
     * @Route("/bibliotroc", name="bibliotroc")
     */
    public function index(): Response
    {
        return $this->render('bibliotroc/index.html.twig', [
            'controller_name' => 'BibliotrocController',
        ]);
    }

    /**
     *@Route("/", name="home")
     */

     public function home(){
        $nbre = 0;
        return $this->render('bibliotroc/home.html.twig', [
            'nbre' => $nbre
        ]);
     
     }

     /**
      * @Route("show/1", name="show")
      */

      public function show(){
          return $this->render('bibliotroc/showLivre.html.twig',[
              
          ]);
      }
      
     /**
     * @Route("/showStock",name="show_stock")
    */
    public function showStock(Request $request, EntityManagerInterface $manager, PossederRepository $repo, CategoriesRepository $repocategorie){
        $user = $this->getUser();
        $stockers= $repo->findBy(['idUser'=>$user]);
          $categorie=$repocategorie->findAll();
          return $this->render('biblio/monStocker.html.twig',[
            'stockers' => $stockers  ,
            'categories' => $categorie
        ]);
    }
      #[Route('/addStock/{id}',name:'add_stock')]
      public function addMyStocke(Livres $livre, Request $request, EntityManagerInterface $manager, PossederRepository $repo, CategoriesRepository $repocategorie){
          $user = $this->getUser();
          if(!$user){
              return $this->redirectToRoute('security_login');
          }else{
              $stocker=new Posseder();  
              $stocker->setUsers($user)
                      ->setLivre($livre);
              $manager->persist($stocker);
              $manager->flush();
              return $this->redirectToRoute('show_stock');
          }
          
      }


      #[Route('/suprimerSockLivre/{id}', name:'suprimer_stock_livre')]
      public function suprimerLivreStocker(Posseder $stocker,  EntityManagerInterface $manager){
        $manager->remove($stocker);
        $manager->flush();
        return $this->redirectToRoute('show_stock');
      }
}
