<?php

namespace App\DataFixtures;

use App\Entity\StatutEmploye;
use App\Factory\EmployeFactory;
use App\Factory\ProjetFactory;
use App\Factory\TacheFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 0. Création des Statuts d'employé (s'ils n'existent pas)
        $statutsLibelles = ['CDI', 'CDD', 'Stagiaire', 'Alternant'];
        $statuts = [];
        
        foreach ($statutsLibelles as $libelle) {
            $statut = new StatutEmploye();
            $statut->setLibelle($libelle);
            $manager->persist($statut);
            $statuts[$libelle] = $statut;
        }
        $manager->flush(); // Flush pour avoir les IDs des statuts

        // 1. Création des Employés
        // Créer 2 chefs de projet (ROLE_ADMIN)
        $admins = EmployeFactory::new()
            ->asAdmin()
            ->many(2)
            ->create(function() use ($statuts) {
                return [
                    'statut' => faker()->randomElement($statuts),
                ];
            });

        // Créer 13 collaborateurs (ROLE_USER)
        $collaborateurs = EmployeFactory::new()
            ->asCollaborateur()
            ->many(13)
            ->create(function() use ($statuts) {
                return [
                    'statut' => faker()->randomElement($statuts),
                ];
            });

        // Combiner tous les employés
        $employes = array_merge($admins, $collaborateurs);
        
        // 2. Création des Projets (avec relations Many-to-Many)
        ProjetFactory::createMany(5, function() use ($employes) {
            $faker = faker(); 
            $membresDuProjet = $faker->randomElements($employes, $faker->numberBetween(3, 8));

            return [
                'titre' => $faker->unique()->company(), 
                'membres' => $membresDuProjet, 
            ];
        });
        
        // 3. Création des Tâches (avec relations Many-to-One)
        TacheFactory::createMany(100, function() use ($employes) {
            $faker = faker(); 
            $employeAssigne = $faker->boolean(75) ? $faker->randomElement($employes) : null;
            
            return [
                'projet' => ProjetFactory::random(),
                'employeAssigne' => $employeAssigne,
            ];
        });

        $manager->flush();
    }
}