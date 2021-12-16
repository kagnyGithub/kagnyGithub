<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Livres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
            ->add('disponible', ChoiceType::class, [
                'choices' => [
                    'Oui'=> 'oui',
                    'Non' =>'Non',
                ],
                ])
            ->add('nbrePage', IntegerType::class)
            ->add('nbrePoint', IntegerType::class)
            ->add('resumer')
            ->add('categorie', EntityType::class, [
                'class' => Categories::class,
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
