<?php

namespace App\Controller;

use App\Entity\Competance;
use App\Entity\Projet;
use App\Form\CompetanceType;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProjetController extends AbstractController
{
    //----------------consturct instanciation du manager
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    //-------------------------------- debut des Fonction pour la class Projet
    //----------------------------creation du formulaire d'ajout de projet + l'import d'img
    /**
     * @Route("/projet", name="app_projet")
     */
    public function index(Request $request,SluggerInterface $slugger): Response
    {
        $projet = new Projet();

        $add = $this->createForm(ProjetType::class, $projet);
        $add->handleRequest($request);

        if($add->isSubmitted() && $add->isValid()){
            $imgProjet = $add->get("img")->getData();
            if($imgProjet){
               $originalFileName = pathinfo($imgProjet->getClientOriginalName(),PATHINFO_FILENAME);

               $safeFileName = $slugger->slug($originalFileName);
               $newfileName = $safeFileName.'-'.uniqid().'.'. $imgProjet->guessExtension();

               try{
                $imgProjet->move($this->getParameter('img'), $newfileName);

               }catch(FileException $erreur){

               }
               $projet->setImg($newfileName);
           
            }
            $this->manager->persist($projet);
            $this->manager->flush();

            return $this->redirectToRoute('app_all_projet');
        }

        return $this->render('projet/index.html.twig', [
            'addForm' => $add->createView(),
        ]);
    }

    //--------------------------function qui sert a recuperer tout mes projet en bdd
    /**
     * @Route("/", name="app_all_projet")
     */
    public function all(): Response{
        $projet = $this->manager->getRepository(Projet::class)->findAll();

        return $this->render('projet/allProjets.html.twig', [
            'projets' => $projet,
        ]);
    }

    //-------------------function qui sert a recuperer grace a l'id le projet et l'afficher 
    /**
     * @Route("/single/projet/{id}", name="app_single_projet")
     */
    public function single(Projet $id): Response{
        $projet = $this->manager->getRepository(Projet::class)->find($id);

        return $this->render('projet/single.html.twig', [
            'projets' => $projet,
        ]);
    }

    
    //function serivra de gestion des projets
    /**
     * @Route("all/admin/projet", name="app_admin_all_projet")
     */
    public function adminTab(): Response{
        $projet = $this->manager->getRepository(Projet::class)->findAll();

        // J'INSTANTIE LES COMPETANCE POUR LES AFFICHER DANS LE MEME FICHIER 'GESTION'
        $competance = new Competance;
        $competance = $this->manager->getRepository(Competance::class)->findAll();

        return $this->render('projet/gestion.html.twig', [
            'projets' => $projet,
            'competance'=>$competance,
        ]);
    }

    //------------------function serivra a supp des projets
    /**
     * @Route("/all/admin/delete/projet/{id}", name="app_admin_delete_projet")
     */
    public function admindelete(Projet $projet): Response{
        $this->manager->remove($projet);
        $this->manager->flush();

        return $this->redirectToRoute('app_admin_all_projet');;
    }
    //--------------- function modifier projet 'les production'
    /**
     * @Route("/admin/projet/edit/{id}", name="app_admin_edit_projet")
     */
    public function edit(Projet $projet, Request $request, SluggerInterface $slugger): Response{

        $formEdit = $this->createForm(ProjetType::class, $projet);

        $formEdit->handleRequest($request);

        if($formEdit->isSubmitted() && $formEdit->isValid()){
            $imgProjet = $formEdit->get("img")->getData();
            if($imgProjet){
               $originalFileName = pathinfo($imgProjet->getClientOriginalName(),PATHINFO_FILENAME);

               $safeFileName = $slugger->slug($originalFileName);
               $newfileName = $safeFileName.'-'.uniqid().'.'. $imgProjet->guessExtension();

               try{
                $imgProjet->move($this->getParameter('img'), $newfileName);

               }catch(FileException $erreur){

               }
               $projet->setImg($newfileName);
           
            }
            $this->manager->persist($projet);
            $this->manager->flush();        
        
            return $this->redirectToRoute('app_admin_all_projet');
        }
       

        return $this->render('projet/Modifier.html.twig', [
            'modif' => $formEdit->createView(),
        ]);       
        

    }


    //--------------------------Fin des function de la class projet

    //------------------Debut des function de la class Competance
    //------------------function pour supprimer les competance dans le tableau gestion
    /**
     * @Route("/all/admin/delete/comp/{id}", name="app_admin_delete_comp")
     */
    public function admindeleteComp(Competance $competance): Response{ 
       $this->manager->remove($competance);
       $this->manager->flush();

       return $this->redirectToRoute('app_admin_all_projet');
    }

    //------------------function pour modifier les competance dans le tableau gestion
    /**
     * @Route("/all/admin/edit/comp/{id}", name="app_admin_edit_comp")
     */
    public function adminEditComp(Competance $competance, Request $request): Response{

        $compModif = $this->createForm(CompetanceType::class, $competance);
        $compModif->handleRequest($request);

        if($compModif->isSubmitted() && $compModif->isValid()){
            $this->manager->persist($competance);
            $this->manager->flush();        
        
            return $this->redirectToRoute('app_admin_all_projet');
        }
       

        return $this->render('competance/editComp.html.twig', [
            'modif' => $compModif->createView(),
        ]);  
    }


}
