<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Projet;
use App\Entity\Tache;
use App\Entity\StatusEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $projet = $options['projet'] ?? null;

        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de la tâche',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => false,
            ])
            ->add('deadline', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('statut', EnumType::class, [
                'label' => 'Statut',
                'class' => StatusEnum::class, // Utilise l'énumération
                'choice_label' => fn (StatusEnum $enum) => $enum->value, // Pour l'affichage
                'data' => $options['data']->getStatut(), // Pré-sélectionner la valeur existante
            ])
            ->add('employeAssigne', EntityType::class, [
                'class' => Employe::class,
                // On filtre les employés pour n'afficher que ceux qui sont membres du projet, si le projet est défini
                'query_builder' => $projet
                    ? fn($er) => $er->createQueryBuilder('e')
                        ->join('e.projets', 'p')
                        ->where('p.id = :projetId')
                        ->setParameter('projetId', $projet->getId())
                    : null,
                'choice_label' => fn(Employe $employe) => $employe->getPrenom() . ' ' . $employe->getNom(),
                'label' => 'Membre',
                'required' => false,
                'placeholder' => '', // Permet de ne pas assigner de membre
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            'projet' => null, // Permet de passer le projet lors de la création du formulaire
        ]);

        $resolver->setAllowedTypes('projet', ['null', 'App\Entity\Projet']);
    }
}
