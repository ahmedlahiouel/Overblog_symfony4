<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursusscollectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('liste', CollectionType::class, array('entry_type' => CursusFormType::class,'by_reference' => false,'entry_options' => array('label' => false),'allow_add' => true,'allow_delete' => true,'prototype' => true,'attr' => array('class' => 'collection-selector',)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
