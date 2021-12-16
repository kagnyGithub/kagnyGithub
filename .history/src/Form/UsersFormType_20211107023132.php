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
                "required" => false
            ])
            ->add('prenom',TextType::class, [
                "required" => false              
                ])
            ->add('password', PasswordType::class)
            ->add('email',TextType::class, [
                "required" => false
                ])
            ->add('civilite', ChoiceType::class, [
                "label"=> "Civilite :",
                'choices' => [
                    'Homme'=> 'H',
                    'Femme' =>'F'
                ],
                ])
            ->add('adresse',TextType::class, [
                "required" => false
                ])
            ->add('codePostale')
            ->add('ville',TextType::class, [
                "required" => false
                ])
            ->add('pays', ChoiceType::class, [
                'choices' => [
                    'Senegal'=> 'Senegal',
                ],
                ])
            ->add('nbrePoint')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
