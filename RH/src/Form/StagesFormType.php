<?php

namespace App\Form;

use App\Entity\Stages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('objet_description', TextareaType::class, array(
            'attr' => array('class' => 'tinymce')));


        $builder->add('etablissement', TextType::class, array('label' => 'Etablissement'));

        $builder->add('Debut', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Début',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);
        $builder->add('fin', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Fin',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stages::class,
        ]);
    }
}
