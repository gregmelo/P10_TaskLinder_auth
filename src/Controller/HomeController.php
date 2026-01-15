<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        //ont récupère tout les projets non archivés
        $projets = $projetRepository->findBy(['estArchive' => false], ['titre' => 'ASC']);

        return $this->render('home/index.html.twig', [
            'projets' => $projets,
            'page_title' => 'Projets',
        ]);
    }
}
