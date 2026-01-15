<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Projet;
use App\Entity\Tache;
use App\Form\TacheType;
use App\Entity\StatusEnum;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


final class TacheController extends AbstractController
{
// Route de création de tâche, prend le projet ID et un statut initial (optionnel)
    #[Route('/tache/{projetId}/new/{initialStatut}', name: 'app_tache_add', defaults: ['initialStatut' => null])]
    public function add(Projet $projetId, Request $request, EntityManagerInterface $entityManager, ?string $initialStatut): Response
    {
        // $projetId est automatiquement converti en objet Projet par le Param Converter (en le renommant Projet $projet)
        $projet = $projetId; 
        $tache = new Tache();

        // Si un statut initial est passé dans l'URL (par ex. en cliquant sur "Ajouter" dans la colonne "Doing")
        if ($initialStatut && StatusEnum::tryFrom($initialStatut)) {
            $tache->setStatut(StatusEnum::from($initialStatut));
        } else {
            // Statut par défaut si non spécifié
            $tache->setStatut(StatusEnum::Todo);
        }
        
        // Lie la tâche au projet
        $tache->setProjet($projet);

        // Crée le formulaire en passant le projet pour filtrer les membres
        $form = $this->createForm(TacheType::class, $tache, ['projet' => $projet]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tache);
            $entityManager->flush();

            $this->addFlash('success', 'La tâche a été créée avec succès.');
            // Redirection vers la fiche projet pour voir la tâche dans le tableau
            return $this->redirectToRoute('app_projet_fiche', ['id' => $projet->getId()]);
        }

        return $this->render('tache/add.html.twig', [
            'tacheForm' => $form->createView(),
            'projet' => $projet,
            'page_title' => 'Créer une tâche',
        ]);
    }

    // Route de modification/affichage de tâche, prend l'ID de la tâche
    #[Route('/tache/{id}', name: 'app_tache_edit')]
    public function edit(Tache $tache, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Le Param Converter récupère la tâche
        $projet = $tache->getProjet();

        // Crée le formulaire en passant le projet pour le filtre des membres
        $form = $this->createForm(TacheType::class, $tache, ['projet' => $projet]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La tâche "' . $tache->getTitre() . '" a été mise à jour.');
            // Redirection vers la fiche projet
            return $this->redirectToRoute('app_projet_fiche', ['id' => $projet->getId()]);
        }
        
        return $this->render('tache/edit.html.twig', [
            'tacheForm' => $form->createView(),
            'tache' => $tache,
            'projet' => $projet,
            'page_title' => $tache->getTitre(),
        ]);
    }

    #[Route('/tache/{id}/delete', name: 'app_tache_delete', methods: ['GET', 'POST'])]
    public function delete(Tache $tache, EntityManagerInterface $entityManager): Response
    {
        // Le Param Converter récupère la tâche
        $projet = $tache->getProjet();
        
        // Suppression de la tâche
        $entityManager->remove($tache);
        $entityManager->flush();

        $this->addFlash('success', 'La tâche "' . $tache->getTitre() . '" a été supprimée.');
        // Redirection vers la fiche projet
        return $this->redirectToRoute('app_projet_fiche', ['id' => $projet->getId()]);
    }
}
