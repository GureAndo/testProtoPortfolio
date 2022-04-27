<?php

namespace App\Controller;

use App\Entity\Competance;
use App\Form\CompetanceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompetanceController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * @Route("/competance", name="app_competance")
     */
    public function index(Request $request): Response
    {
        $comp = new Competance();

        $form = $this->createForm(CompetanceType::class, $comp);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($comp);
            $this->manager->flush();

            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('competance/index.html.twig', [
            'formComp' => $form->createView(),
        ]);
    }

    /**
     * @Route("all/comp", name="app_all_comp")
     */
    public function message(): Response{
        $comp = $this->manager->getRepository(Competance::class)->findAll();

        return $this->render('competance/listeCompetance.html.twig', [
            'comp' => $comp,
        ]);
    }

}