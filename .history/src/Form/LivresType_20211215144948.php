<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomLivre',TextType::class)
            ->add('auteur')
            ->add('editeur')
            ->add('codeBare')
            ->add('parution')
            ->add('langue',ChoiceType::class, [
                'choices' => [
                    'Francais'=> 'francais',
                    'Anglais' =>'Anglais',
                    'Espagnol' => 'Espagnol',
                    'Arabe' => 'Arabe',
                    'Portugais' => 'Portugais'
                ],
                ])
            ->add('format',ChoiceType::class, [
                'choices' => [
                    'Poche'=> 'Poche',
                    'Grande Format' =>'Grande',
                ],
                ])
            ->add('nbrPage', IntegerType::class)
            ->add('resumer')
            ->add('nbrPoint', IntegerType::class)
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nomCategorie'
            ])
        ;
    }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
