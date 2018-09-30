<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 16/08/17
 * Time: 02:02 م
 */

namespace test\userBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ProfileFormType extends BaseType
{

    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);
        $type = $options["label"];
        if ($type == "admin") {
            $builder
                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', null, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'));
        } elseif ($type == "soc") {
            // custom field
            $builder
                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', null, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                ->add('secteur', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'secteur', 'translation_domain' => 'FOSUserBundle'));
        } else {
            $builder->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
                ->add('email', null, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
                ->add('prenom', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\TextType'), array('label' => 'prenom', 'translation_domain' => 'FOSUserBundle'));

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


    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $constraintsOptions = array(
            'message' => 'fos_user.current_password.invalid',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword($constraintsOptions),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'profile',
            // BC for SF < 2.8
            'intention' => 'profile',
        ));
    }

    // BC for SF < 3.0

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'fos_user_profile';
    }
}