<?php

namespace App\Factory;

use App\Entity\StatusEnum;
use App\Entity\Tache;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Tache>
 */
final class TacheFactory extends PersistentProxyObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Tache::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        return [
            'titre' => self::faker()->sentence(4),
            'description' => self::faker()->boolean(70) ? self::faker()->paragraph(2) : null,
            'deadline' => self::faker()->boolean(60) ? self::faker()->dateTimeBetween('now', '+3 months') : null,
            'statut' => self::faker()->randomElement(StatusEnum::cases()),
            'projet' => ProjetFactory::new(),
            'employeAssigne' => null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Tache $tache): void {})
        ;
    }
}
