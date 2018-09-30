<?php

namespace App\Form;

use App\Entity\Langues;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\LanguageType as BaseLanguageType;
class LanguesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('langues', BaseLanguageType::class,  array('label' => 'Language'));
        $builder->add('niveaux',ChoiceType::class,array('label'=>'Niveaux :','choices'=>array('Débutant'=>'Débutant','lue uniquement'=>'lue uniquement','lue et parlée'=>'lue et parlée','lue,parlée et ecrite'=>'lue,parlée et ecrite'),'attr'=>array('class'=>'form-control')));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Langues::class,
        ]);
    }
}
