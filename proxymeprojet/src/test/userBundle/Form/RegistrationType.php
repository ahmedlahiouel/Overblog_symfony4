<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 15/08/17
 * Time: 10:10 ص
 */

namespace test\userBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use FOS\UserBundle\Util\LegacyFormHelper;

class RegistrationType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $type = $options["label"];
        if ($type == "admin") {

        } elseif ($type == "soc") {
            $builder->add('secteur', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'secteur', 'translation_domain' => 'FOSUserBundle'));
        } else {
            $builder->add('prenom', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'prenom', 'translation_domain' => 'FOSUserBundle'));

            $builder->add('ville', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'ville', 'translation_domain' => 'FOSUserBundle'));
            $builder->add('tl', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'telephone', 'translation_domain' => 'FOSUserBundle'));
            $builder->add('pays', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'pays', 'translation_domain' => 'FOSUserBundle'));


            $builder->add('date', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'label' => 'date',
                'attr' => [

                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy']]);

        }

    }


    public function getParent()

    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()

    {
        return 'app_user_registration';
    }

    public function getName()

    {
        return $this->getBlockPrefix();
    }

}