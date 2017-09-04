<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ScenarioInquestValidatorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('validator', EntityType::class, [
                    'placeholder' => 'Choose a validator',
                    'required' => true,
                    'class' => 'AppBundle\Entity\Validator',
                    'attr' => [
                        'class' => 'scenario-inquest-validator-dropdown',
                    ]
                ])
                ->add('validatorParameter', TextType::class, [
                    'required' => false,
                    'label' => 'Parameter'
                ])
                ->add('validatorComparison', TextType::class, [
                    'required' => false,
                    'label' => 'Comparison'
                ])
                ->add('validatorSortorder', HiddenType::class, [
                    'required' => true,
                    'label' => 'Sortorder',
                    'attr' => [
                        'class' => 'scenario-inquest-validator-sortorder',
                    ]
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ScenarioInquestValidator'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_scenarioinquestvalidator';
    }


}
