<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                "required" => true
            ])
            ->add('prenom',TextType::class, [
                "required" => true             
                ])
            ->add('password', PasswordType::class)
            ->add('email',TextType::class, [
                "required" => true
                ])
            ->add('civilite', ChoiceType::class, [
                "label"=> "Civilite :",
                'choices' => [
                    'Homme'=> 'H',
                    'Femme' =>'F'
                ],
                ])
            ->add('adresse',TextType::class, [
                "required" => true
                ])
            ->add('codePostale')
            ->add('ville',TextType::class, [
                "required" => true
                ])
            ->add('pays', ChoiceType::class, [
                'choices' => [
                    'Senegal'=> 'Senegal',
                ],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
