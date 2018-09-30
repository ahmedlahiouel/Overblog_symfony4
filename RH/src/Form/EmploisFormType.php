<?php

namespace App\Form;

use App\Entity\Emplois;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmploisFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lieu', TextType::class, array('label' => 'Lieu'));
        $builder->add('secteur', TextType::class, array('label' => 'Secteur'));
        $builder->add('fonction', TextType::class, array('label' => 'Fonction'));
        $builder->add('salaire_net', TextType::class, array('label' => 'Salaire Net'));
        $builder->add('motif_depart', TextType::class, array('label' => 'Motif Depart'));


        $builder->add('etablissement', TextType::class, array('label' => 'Etablissement'));

        $builder->add('embauche', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Embauche',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);
        $builder->add('depart', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Depart',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emplois::class,
        ]);
    }
}
