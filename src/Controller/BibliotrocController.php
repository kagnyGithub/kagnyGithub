<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Entity\Categories;
use App\Entity\Posseder;
use App\Form\LivresType;
use App\Repository\LivresRepository;
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
     
    public function home(Request $request, LivresRepository $rep, CategoriesRepository $repoCategorie ){
        $livres=$rep->findAll(['limit'=>10]);
        $categorie=$repoCategorie->findAll();
        return $this->render('bibliotroc/home.html.twig', [
            'livres' => $livres,
            'categories' => $categorie
        ]);
    }

     /**
      * @Route("show/{id}", name="show_livre")
      */
      public function showLivre(Livres $livre, LivresRepository $repo, CategoriesRepository $repoCategorie){
        $categorie= $livre->getCategorie();
        $categories=$repoCategorie->findAll();
        $Livres=$repo->findBy(['categorie'=> $categorie]);
        return $this->render('bibliotroc/showLivre.html.twig',[
            'livre' => $livre,
            'livres' => $Livres,
            'categories' => $categories
        ]);
    }

       /**
        * @Route("/livres/{id}", name="page_livre")
       */
    public function rubriqueLivres($id, LivresRepository $rep, CategoriesRepository $repocategorie){
         $categories= $repocategorie->findBy(['id'=>$id]);
        $Livres=$rep->findBy(['categorie'=> $categories]);
        $categorie=$repocategorie->findAll();
       
        return $this->render('bibliotroc/PageLivre.html.twig',[
            'livres' => $Livres,
            'categorie' => $categorie,
            'nomcategorie'=> $categories[0]->getNomCategorie()
        ]);
    }
      
     /**
     * @Route("/showStock",name="show_stock")
    */
    public function showStock(Request $request, EntityManagerInterface $manager, PossederRepository $repo, CategoriesRepository $repocategorie){
        $user = $this->getUser();
        $stockers= $repo->findBy(['users'=>$user]);
          $categorie=$repocategorie->findAll();
          return $this->render('bibliotroc/monStocker.html.twig',[
            'stockers' => $stockers  ,
            'categories' => $categorie
        ]);
    }
      
    /**
    * @Route("/addStock/{id}",name="add_stock")
    */
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


       /**
      * @Route("/suprimerSockLivre/{id}", name="suprimer_stock_livre")
      */
      public function suprimerLivreStocker(Posseder $stocker,  EntityManagerInterface $manager){
        $manager->remove($stocker);
        $manager->flush();
        return $this->redirectToRoute('show_stock');
      }

      /**
     * @Route("/addLivre",name="livre_add")
    */
    public function addLivre(Request $request, EntityManagerInterface $manager, CategoriesRepository $repoCategorie){
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($livre);
            $manager->flush();
        }
        $categorie=$repoCategorie->findAll();
        return $this->render('bibliotroc/addLivre.html.twig',[
            'formLivre' => $form->createView(),
            'categories' => $categorie
        ]);
    }    
    /**
     * @Route("/commande/{id}",name="commande")
    */
      public function commande($id, LivresRepository $repo, CategoriesRepository $repoCategorie, PossederRepository $possede){
          $livre=$repo->findBy(['id'=>$id]);
        $categories=$repoCategorie->findAll();
        $membrePosseder=$possede->findBy(['livre'=>$livre]);
        return $this->render('bibliotroc/possede.html.twig',[
            'categories' => $categories,
            'membrePosseder'=>$membrePosseder
        ]);
      }
}
