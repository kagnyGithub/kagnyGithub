<?php

namespace App\Form;

use App\Entity\Livres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomLivre')
            ->add('auteur')
            ->add('editeur')
            ->add('parution')
            ->add('codeBare')
            ->add('format', ChoiceType::class, [
                'choices' => [
                    'Poche'=> 'Poche',
                    'Grande Format' =>'Grande',
                ],
                ])
            ->add('nbrePage', IntegerType::class)
            ->add('nbrePoint', IntegerType::class)
            ->add('resumer')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nomCategorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livres::class,
        ]);
    }
}
