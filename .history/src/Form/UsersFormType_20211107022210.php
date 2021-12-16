<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                "label" => "Nom :",
                "required" => false,
               
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('prenom',TextType::class, [
                "label" => "Prenom :",
                "required" => false,
               
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('password')
            ->add('email',TextType::class, [
                "label" => "Email :",
                "required" => false,
               
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('civilite', ChoiceType::class, [
                "label"=> "Civilite :",
                'choices' => [
                    'Homme'=> 'H',
                    'Femme' =>'F'
                ],
                ])
            ->add('adresse',TextType::class, [
                "label" => "Adresse :",
                "required" => false,
               
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('codePostale')
            ->add('ville',TextType::class, [
                "label" => "Ville :",
                "required" => false,
                
                "attr" => [
                    "class" => "form-control",
                ]
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
