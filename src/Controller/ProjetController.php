<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\StatusEnum;
use App\Repository\TacheRepository;

final class ProjetController extends AbstractController
{
// Route de création de projet (correspond à projet_add.html)
    #[Route('/projet/new', name: 'app_projet_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // L'état est_archive est False par défaut, pas besoin de le modifier
            $entityManager->persist($projet);
            $entityManager->flush();

            // Redirection vers la fiche du projet créé (route 'app_projet_fiche' que nous allons créer)
            $this->addFlash('success', 'Le projet a été créé avec succès.');
            return $this->redirectToRoute('app_projet_fiche', ['id' => $projet->getId()]);
        }

        return $this->render('projet/add.html.twig', [
            'projetForm' => $form->createView(),
            'page_title' => 'Nouveau projet',
        ]);
    }

    // Route de la fiche projet, récupère le projet grâce à {id}
    #[Route('/projet/{id}', name: 'app_projet_fiche')]
    public function show(Projet $projet, TacheRepository $tacheRepository): Response
    {
        // === NOUVELLE LOGIQUE : VÉRIFICATION DU STATUT ARCHIVÉ ===
    if ($projet->isEstArchive()) { 
        
        return $this->render('projet/archived.html.twig', [
            'page_title' => 'Projet Archivé',
        ], new Response(null, Response::HTTP_FORBIDDEN));
    }

        // $taches = $projet->getTaches(); // Cette méthode existe grâce à l'ORM
        $taches = $tacheRepository->findByProjetSortedByDeadline($projet->getId());

        $tachesParStatut = [
            StatusEnum::Todo->value => [],
            StatusEnum::Doing->value => [],
            StatusEnum::Done->value => [],
        ];

        foreach ($taches as $tache) {
            // Le statut est un objet Enum, ont utilise value pour récupérer la valeur sous forme de string
            $tachesParStatut[$tache->getStatut()->value][] = $tache;
        }

        return $this->render('projet/show.html.twig', [
            'projet' => $projet,
            'tachesParStatut' => $tachesParStatut,
            'page_title' => $projet->getTitre(),
        ]);
    }

    #[Route('/projet/{id}/edit', name: 'app_projet_edit')]
    public function edit(Projet $projet, Request $request, EntityManagerInterface $entityManager): Response
    {
        // === NOUVELLE LOGIQUE : VÉRIFICATION DU STATUT ARCHIVÉ ===
    if ($projet->isEstArchive()) {
        return $this->render('projet/archived.html.twig', [
            'page_title' => 'Projet Archivé',
        ], new Response(null, Response::HTTP_FORBIDDEN));
    }

        // Projet $projet récupère l'entité existante
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Le projet a été modifié avec succès.');
            return $this->redirectToRoute('app_projet_fiche', ['id' => $projet->getId()]);
        }

        return $this->render('projet/edit.html.twig', [
            'projetForm' => $form->createView(),
            'projet' => $projet,
            'page_title' => 'Éditer ' . $projet->getTitre(),
        ]);
    }

    #[Route('/projet/{id}/archive', name: 'app_projet_archive')]
    public function archive(Projet $projet, EntityManagerInterface $entityManager): Response
    {
        // Archivage (n'apparaît plus dans la liste)
        $projet->setEstArchive(true); 
        $entityManager->flush();

        $this->addFlash('success', 'Le projet "' . $projet->getTitre() . '" a été archivé.');
        return $this->redirectToRoute('app_home');
    }
}
