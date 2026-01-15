<?php

namespace App\DataFixtures;

use App\Factory\EmployeFactory;
use App\Factory\ProjetFactory;
use App\Factory\TacheFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Zenstruck\Foundry\Proxy;
// Importez la fonction utilitaire faker() pour l'utiliser directement :
use function Zenstruck\Foundry\faker;
use Zenstruck\Foundry\FactoryCollection;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Création des Employés
        /** @var Proxy[] $employes */
        $employes = EmployeFactory::createMany(15);
        
        // 2. Création des Projets (avec relations Many-to-Many)
        ProjetFactory::createMany(5, function() use ($employes) {
            
            $faker = faker(); 
            
            // CORRECTION ICI : Passer la collection $employes directement
            // La méthode randomElements de Faker gère souvent les collections/proxies.
            $membresDuProjet = $faker->randomElements($employes, $faker->numberBetween(3, 8));

            return [
                'titre' => $faker->unique()->company(), 
                'membres' => $membresDuProjet, 
            ];
        });
        
        // 3. Création des Tâches (avec relations Many-to-One)
        
        TacheFactory::createMany(100, function() use ($employes) {
            
            $faker = faker(); 
            
            // 75% de chance qu'une tâche soit assignée à un employé existant.
            $employeAssigne = $faker->boolean(75) ? $faker->randomElement($employes) : null;
            
            return [
                'projet' => ProjetFactory::random(),
                'employeAssigne' => $employeAssigne,
            ];
        });

        $manager->flush();
    }
}
