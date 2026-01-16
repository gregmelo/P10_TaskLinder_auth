<?php

namespace App\Controller;

use App\Entity\Employe;
use App\Form\RegistrationFormType;
use App\Repository\StatutEmployeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegistrationController extends AbstractController
{
    /**
     * Gère l'inscription d'un nouvel employé
     * 
     * @param Request $request - Contient les données envoyées par le formulaire
     * @param UserPasswordHasherInterface $passwordHasher - Service pour hasher le mot de passe
     * @param EntityManagerInterface $entityManager - Service pour sauvegarder en BDD
     * @param StatutEmployeRepository $statutEmployeRepository - Pour récupérer le statut CDI
     */
    #[Route('/inscription', name: 'app_registration')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        StatutEmployeRepository $statutEmployeRepository
    ): Response {
        // Créer un nouvel objet Employe vide
        $employe = new Employe();

        // Créer le formulaire et le lier à l'objet Employe
        $form = $this->createForm(RegistrationFormType::class, $employe);

        // Le formulaire analyse la requête pour voir si des données ont été soumises
        $form->handleRequest($request);

        // Vérifier si le formulaire a été soumis ET si les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {
            
            // Récupérer le mot de passe en clair depuis le champ "plainPassword"
            //    (ce champ n'est pas mappé à l'entité, donc on le récupère manuellement)
            $plainPassword = $form->get('plainPassword')->getData();

            // Hasher le mot de passe (le transformer en chaîne chiffrée)
            //    Exemple : "MonMotDePasse123!" devient "$2y$13$kX9z..."
            $hashedPassword = $passwordHasher->hashPassword($employe, $plainPassword);

            // Stocker le mot de passe hashé dans l'entité
            $employe->setPassword($hashedPassword);

            // Définir la date d'entrée à aujourd'hui
            $employe->setDateEntree(new \DateTime());

            // Récupérer le statut "CDI" depuis la base de données
            $statutCDI = $statutEmployeRepository->findOneBy(['libelle' => 'CDI']);

            // Assigner le statut CDI à l'employé
            $employe->setStatut($statutCDI);

            // Dire à Doctrine de "suivre" cet objet pour la sauvegarde
            $entityManager->persist($employe);

            // Exécuter réellement la sauvegarde en base de données (INSERT SQL)
            $entityManager->flush();

            // Ajouter un message flash de succès (affiché sur la page suivante)
            $this->addFlash('success', 'Votre compte a été créé avec succès !');

            // Rediriger vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }

        // Si le formulaire n'est pas soumis ou pas valide, afficher la page
        return $this->render('auth/index.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}