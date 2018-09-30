<?php

namespace App\Form;

use App\Entity\Questions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       ->add('enance', TextareaType::class, array(
            'attr' => array('class' => 'tinymce')))
        ->add('type',ChoiceType::class,array('label'=>'Type Questions :','choices'=>array('Expérience Professionnelle'=>'Expérience Professionnelle','Recherche emploi'=>'Recherche emploi'),'attr'=>array('class'=>'form-control')));

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
