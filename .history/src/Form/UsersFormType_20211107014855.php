<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, [
                "label" => "Nom :",
                "required" => false,
                "placeholder" => "Entrez votre nom ...",
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('prenom',TextType::class, [
                "label" => "Prenom :",
                "required" => false,
                "placeholder" => "Entrez votre prenom ...",
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('password')
            ->add('email',TextType::class, [
                "label" => "Email :",
                "required" => false,
                "placeholder" => "ex:monmail@gamil.com ...",
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('civilite')
            ->add('adresse',TextType::class, [
                "label" => "Adresse :",
                "required" => false,
                "placeholder" => "Entrez votre adresse ...",
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('codePostale')
            ->add('ville',TextType::class, [
                "label" => "Ville :",
                "required" => false,
                "placeholder" => "Entrez votre ville ...",
                "attr" => [
                    "class" => "form-control",
                ]
                ])
            ->add('pays')
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
