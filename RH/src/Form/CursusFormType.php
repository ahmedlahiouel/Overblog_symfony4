<?php

namespace App\Form;

use App\Entity\Cursus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CursusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etablissement', TextType::class, array('label' => 'Etablissement'));

        $builder->add('diplome', TextType::class, array('label' => 'Diplome'));

        $builder->add('specialite', TextType::class, array('label' => 'Specialite'));

        $builder->add('date_entree', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Entrée',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);
        $builder->add('date_sortie', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Sortie',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cursus::class,
        ]);
    }
}
