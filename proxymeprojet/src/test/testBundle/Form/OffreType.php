<?php

namespace test\testBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class OffreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre')->add('description')->add('salaire')->add('lieu')->add('categorie')->add('Qcm')->add('categorie',EntityType::class, array('class'=>'test\testBundle\Entity\categorie',
            'choice_label'=>'type'))->add('Qcm',EntityType::class, array('class'=>'test\testBundle\Entity\Qcm',
            'choice_label'=>'enance'))->add('ajouter',SubmitType::class);


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'test\testBundle\Entity\Offre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'test_testbundle_offre';
    }


}
