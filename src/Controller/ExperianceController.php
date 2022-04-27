<?php

namespace App\Controller;

use App\Entity\Experiance;
use App\Form\ExperianceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperianceController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/experiance", name="app_experiance")
     */
    public function index(Request $request): Response
    {

        $experiance = new Experiance();
        $form = $this->createForm(ExperianceType::class, $experiance);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($experiance);
            $this->manager->flush();

            return $this->redirectToRoute('app_home');
        }


        return $this->render('experiance/index.html.twig', [
            'formXP' => $form->createView(),
        ]);
    }

    /**
     * @Route("all/xp", name="app_all_xp")
     */
    public function listXp(): Response{
        $xp = $this->manager->getRepository(Experiance::class)->findAll();

        return $this->render('experiance/listXp.html.twig', [
            'xp' => $xp,
        ]);
    }

    /**
     * @Route("/admin/delete/xp/{id}", name="admin_app_delete_xp")
     */
    public function deleteXp(Experiance $xp): Response{
        
        $this->manager->remove($xp);
        $this->manager->flush();

        return $this->redirectToRoute('app_all_xp');;
       
    }

    /**
     * @Route("/admin/edit/xp/{id}", name="admin_app_edit_xp")
     */
    public function editXp(Request $request, Experiance $xp): Response{
        
        $formEdit = $this->createForm(ExperianceType::class, $xp);
        $formEdit->handleRequest($request);

        if($formEdit->isSubmitted() && $formEdit->isValid()){
        $this->manager->persist($xp);
        $this->manager->flush();
        return $this->redirectToRoute('app_all_xp');
        }

        return $this->render('experiance/Modifier.html.twig', [
            'modif' => $formEdit->createView(),
        ]);
       
    }
}
