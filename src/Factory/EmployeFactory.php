<?php

namespace App\Factory;

use App\Entity\Employe;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Employe>
 */
final class EmployeFactory extends PersistentProxyObjectFactory
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function class(): string
    {
        return Employe::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function defaults(): array|callable
    {
        return [
            'nom' => self::faker()->lastName(),
            'prenom' => self::faker()->firstName(),
            'email' => self::faker()->unique()->email(),
            'dateEntree' => self::faker()->dateTimeBetween('-5 years', 'now'),
            'roles' => ['ROLE_USER'], // Rôle par défaut : collaborateur
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            ->afterInstantiate(function(Employe $employe): void {
                // Hasher le mot de passe par défaut "Test123!@"
                $hashedPassword = $this->passwordHasher->hashPassword($employe, 'Test123!@');
                $employe->setPassword($hashedPassword);
            })
        ;
    }

    /**
     * Créer un chef de projet (ROLE_ADMIN)
     */
    public function asAdmin(): self
    {
        return $this->with(['roles' => ['ROLE_ADMIN']]);
    }

    /**
     * Créer un collaborateur (ROLE_USER)
     */
    public function asCollaborateur(): self
    {
        return $this->with(['roles' => ['ROLE_USER']]);
    }
}