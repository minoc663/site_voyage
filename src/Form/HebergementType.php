<?php

namespace App\Form;

use App\Entity\Hebergement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HebergementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'nom',
                'attr' => ['placeholder' => 'Entrez le nom de l\'hebergement']
            ])
            ->add('adresse', TextType::class, [
                'label' => 'adresse',
                'attr' => ['placeholder' => 'Entrez la ville de l\'hebergement']
            ])
            ->add('telephone', TelType::class, [
                'label' => 'telephone',
                'attr' => ['placeholder' => 'Entrez le numéro de l\'hebergement']
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'attr' => ['placeholder' => 'Entrez une adresse mail valide']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'attr' => ['placeholder' => 'Spécifié une description pour l\'hebergement']
            ])
            ->add('illustration', TextType::class)
            ->add('nombre_nuit', IntegerType::class, [
                'label' => 'nombre_nuit',
                'attr' => ['placeholder' => 'Entrez un nombre de nuit']
            ])
            ->add('nombre_place', IntegerType::class, [
                'label' => 'nombre_place',
                'attr' => ['placeholder' => 'Entrez un nombre de place désirée']
            ])
            ->add('prix', MoneyType::class, [
                'label' => 'prix',
                'attr' => ['placeholder' => 'Entrez un prix']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-dark']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hebergement::class,
        ]);
    }
}
