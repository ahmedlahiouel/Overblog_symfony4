<?php

namespace App\Form;

use App\Entity\Avantages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvantageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {         $builder->add('avantage',ChoiceType::class,array('label'=>'Avantage :','choices'=>array('13 eme salaire'=>'13 eme salaire ','14eme salaire'=>'14eme salaire','Ticket Restaurent'=>'Ticket Restaurent','Voiture De fonction'=>'Voiture De fonction','Autre Prime'=>'Autre Prime','Autre Avantage'=>'Autre Avantage'),'attr'=>array('class'=>'form-control')));
        $builder->add('nom_avantage', TextType::class, array('label' => "Nom de l'aventage "));
        $builder->add('frequence', TextType::class, array('label' => "Fréquence "));
        $builder->add('combien', TextType::class, array('label' => "Combien ?"));
        $builder->add('formule_calcul', TextType::class, array('label' => "Formule De Calcul"));

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Avantages::class,
        ]);
    }
}
