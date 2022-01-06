<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
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
                'placeholder'
                => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute'

                ],

                'years' => range(date('Y'), date('Y') + 10),


            ])

            ->add('date_arrivee', DateTimeType::class, [
                'placeholder'
                => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                    'hour' => 'Hour', 'minute' => 'Minute'

                ],
            ])

            ->add('lieu_depart', TextType::class, [
                'attr' => [
                    'placeholder' => 'Veuillez saisir le lieu de départ'
                ]
            ])

            ->add('lieu_arrivee', TextType::class, [
                'attr' => [
                    'placeholder' => "Veuillez saisir le lieu d'arrivée"
                ]
            ])

            ->add('prix', MoneyType::class)

            ->add('duree_vol', TimeType::class, [
                'placeholder' => 'Select a value'
            ])

            ->add('nombre_place', NumberType::class)

            ->add('date_retour', DateType::class, [
                'placeholder' => ['year' => 'Year', 'month' => 'Month', 'day' => 'Day']
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Validez'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}