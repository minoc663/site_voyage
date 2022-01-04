<?php

namespace App\Form;

use App\Entity\Vol;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnie')
            ->add('date_depart')
            ->add('date_arrivee')
            ->add('lieu_depart')
            ->add('lieu_arrivee')
            ->add('prix')
            ->add('duree_vol')
            ->add('nombre_place')
            ->add('date_retour')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
