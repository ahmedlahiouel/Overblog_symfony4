<?php

namespace App\Form;

use App\Entity\Reference;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom_prenom', TextType::class, array('label' => "Fréquence "));
        $builder->add('fonction', TextType::class, array('label' => "Fonction "));
        $builder->add('entreprise', TextType::class, array('label' => "Entreprise "));
        $builder->add('coordonnees', TextType::class, array('label' => "Coordonnées "));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reference::class,
        ]);
    }
}
