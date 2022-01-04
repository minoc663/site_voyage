<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnie', TextType::class, [
                'label' => 'Le nom de la compagnie',
                'attr' => [
                    'placeholder' => 'Veuillez saisir le nom de la compagnie'
                ]
            ])
            ->add('date_depart', DateTimeType::class, [
                'label' => 'date de départ',

            ])

            ->add('date_arrivee', DateTimeType::class, [
                'placeholder'
                => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'

                ],
            ])

            ->add('lieu_depart')
            ->add('lieu_arrivee')
            ->add('prix')
            ->add('duree_vol')
            ->add('nombre_place')
            ->add('date_retour');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}