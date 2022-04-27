<?php

namespace App\Controller;

use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        $projet = $this->manager->getRepository(Projet::class)->findAll();

        return $this->render('home/index.html.twig', [
            'projets' => $projet,
        ]);
    }
}
