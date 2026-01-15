<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Projet;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre du projet',
            ])
            ->add('membres', EntityType::class, [
                'class' => Employe::class,
                'choice_label' => fn (Employe $employe) => $employe->getPrenom() . ' ' . $employe->getNom(), // Affichage Nom Prénom
                'label' => 'Inviter des membres',
                'multiple' => true, // Permet de sélectionner plusieurs employés
                'required' => false, // La sélection des membres est facultative
                ])
                ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
