<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,[
                'label' => 'Votre nom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('prenom', TextType::class,[
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])
            ->add('genre', ChoiceType::class,[
                'choices' => [
                    'homme' => 'homme',
                    'femme' => 'femme'
                ],
                'label' => 'Votre genre',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre genre'
                ]
            ])
            ->add('date_naissance', BirthdayType::class,[
                'widget' => 'single_text',
                // 'format' => 'yyyy-MM-dd',
                'label' => 'Votre date de naissance',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre date de naissance'
                ]
            ])
            ->add('telephone', TelType::class,[
                'label' => 'Votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre numéro de téléphone'
                ]
            ])
            ->add('adresse', TextType::class,[
                'label' => 'Votre adresse',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre adresse'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => 'Votre email',
                'constraints' => new Length([
                    'min'=> 5,
                    'max' => 30,
                ]),
                'attr' => [
                    'placeholder' => 'Merci de saisir votre email'
                ]
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'label' => 'Votre mot de passe',
                'constraints' => new Length([
                    'min'=> 4,
                    'max' => 15,
                ]),
                'invalid_message' => 'Les mots de passe doivent être identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr'=>[
                    'placeholder' => 'Merci de rentrer votre mot de passe']
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'label' => 'Mot de passe',
                    'attr'=>[
                    'placeholder' => 'Merci de rentrer votre mot de passe']
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire"
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
