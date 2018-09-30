<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', TextType::class, array('label' => 'Nom', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('email', TextType::class, array('label' => 'Email', 'translation_domain' => 'FOSUserBundle'));

        $builder->add('prenom', TextType::class, array('label' => 'Prenom', 'translation_domain' => 'FOSUserBundle'));

        $builder->add('ville', TextType::class, array('label' => 'Ville', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('tl', TextType::class, array('label' => 'Tlephone', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('pays', TextType::class, array('label' => 'Pays', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('cin', TextType::class, array('label' => 'Cin', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('situationfamiliale',ChoiceType::class,array('label'=>'Situation familiale :','choices'=>array('célibataire'=>'célibataire','marié'=>'marié','divorcé'=>'divorcé','veuf'=>'veuf'),'attr'=>array('class'=>'form-control')));
        $builder->add('nbenfants',ChoiceType::class,array('label'=>'Nombre D enfants :','choices'=>array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),'attr'=>array('class'=>'form-control')));

        $builder->add('lieunaissance', TextType::class, array('label' => 'Lieu De  Naissance', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('nationalite', TextType::class, array('label' => 'Nationalité', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('numtlfixe', TextType::class, array('label' => 'Numero Fixe', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('adressepersonelle', TextType::class, array('label' => 'Numero Adress Personelle', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('cite', TextType::class, array('label' => 'Cité', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('codepostal', TextType::class, array('label' => 'Code postal', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('gouvernorat', TextType::class, array('label' => 'Gouvernorat', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('numcnss', TextType::class, array('label' => 'N CNSS', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('rue', TextType::class, array('label' => 'Rue', 'translation_domain' => 'FOSUserBundle'));


        $builder->add('date', DateType::class, [
            'widget' => 'single_text',
            'format' => 'dd-MM-yyyy',
            'label' => 'Date Naissance',
            'attr' => [

                'data-provide' => 'datepicker',
                'data-date-format' => 'dd-mm-yyyy']]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
