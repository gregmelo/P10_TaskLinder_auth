<?php

namespace App\Security\Voter;

use App\Entity\Employe;
use App\Entity\Projet;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Voter pour gérer les droits d'accès aux projets
 * 
 * Règles :
 * - Les chefs de projet (ROLE_ADMIN) peuvent accéder à tous les projets
 * - Les collaborateurs (ROLE_USER) ne peuvent accéder qu'aux projets auxquels ils sont assignés
 */
final class ProjetVoter extends Voter
{
    // Constantes définissant les actions possibles
    public const VIEW = 'PROJET_VIEW';      // Consulter un projet
    public const EDIT = 'PROJET_EDIT';      // Modifier un projet
    public const ACCESS = 'PROJET_ACCESS';  // Accéder aux tâches d'un projet

    /**
     * Vérifie si ce Voter doit gérer cette demande d'autorisation
     */
    protected function supports(string $attribute, mixed $subject): bool
    {
        // Ce Voter gère uniquement les attributs VIEW, EDIT et ACCESS
        // Et uniquement si le sujet est un objet Projet
        return in_array($attribute, [self::VIEW, self::EDIT, self::ACCESS])
            && $subject instanceof Projet;
    }

    /**
     * Décide si l'utilisateur a le droit d'effectuer l'action
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // Si l'utilisateur n'est pas connecté, refuser l'accès
        if (!$user instanceof Employe) {
            return false;
        }

        /** @var Projet $projet */
        $projet = $subject;

        // Les chefs de projet (ROLE_ADMIN) ont accès à tout
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return true;
        }

        // Pour les collaborateurs, vérifier s'ils sont membres du projet
        return match($attribute) {
            self::VIEW, self::ACCESS => $this->isMembre($projet, $user),
            self::EDIT => false, // Seuls les admins peuvent éditer (déjà géré ci-dessus)
            default => false,
        };
    }

    /**
     * Vérifie si l'utilisateur est membre du projet
     */
    private function isMembre(Projet $projet, Employe $user): bool
    {
        // Parcourt les membres du projet pour vérifier si l'utilisateur en fait partie
        foreach ($projet->getMembres() as $membre) {
            if ($membre->getId() === $user->getId()) {
                return true;
            }
        }
        return false;
    }
}