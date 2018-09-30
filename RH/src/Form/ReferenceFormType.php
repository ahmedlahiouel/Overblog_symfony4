<?php

namespace App\Form;

use App\Entity\References;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReferenceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom_prenom', TextType::class, array('label' => "Fréquence "));
        $builder->add('fonction', TextType::class, array('label' => "Fréquence "));
        $builder->add('entreprise', TextType::class, array('label' => "Fréquence "));
        $builder->add('coordonnees', TextType::class, array('label' => "Fréquence "));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => References::class,
        ]);
    }
}
