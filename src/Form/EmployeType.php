<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\StatutEmploye;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prénom',
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
        ])
        ->add('dateEntree', DateType::class, [
            'label' => 'Date d\'entrée',
            'widget' => 'single_text',
        ])
        ->add('statut', EntityType::class, [
            'class' => StatutEmploye::class, // Spécifie l'entité que ce champ doit lister
            'choice_label' => 'libelle', // Spécifie quelle propriété de StatutEmploye afficher dans la liste déroulante
            'label' => 'Statut',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
