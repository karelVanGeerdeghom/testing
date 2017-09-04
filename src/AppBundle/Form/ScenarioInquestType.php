<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ScenarioInquestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inquest', EntityType::class, [
                    'placeholder' => 'Choose an inquest',
                    'class' => 'AppBundle\Entity\Inquest',
                    'required' => true,
                    'attr' => [
                        'class' => 'scenario-inquest-dropdown',
                    ],
                    'query_builder' => function(EntityRepository $entityRepository) use ($options) {
                        return $entityRepository
                                ->createQueryBuilder('i')
                                ->where('i.site = :site')
                                ->setParameter('site', $options['attr']['data-site_id']);
                    }
                ])
                ->add('inquestProtocol', ChoiceType::class, [
                    'label' => 'Protocol',
                    'choices' => [
                        'POST' => 'POST',
                        'GET' => 'GET'
                    ],
                    'required' => true
                ])
                ->add('inquestParameter', TextType::class, [
                    'required' => false,
                    'label' => 'Parameter'
                ])
                ->add('inquestComparison', TextType::class, [
                    'required' => false,
                    'label' => 'Comparison'
                ])
                ->add('inquestSortorder', HiddenType::class, [
                    'required' => true,
                    'label' => 'Sortorder',
                    'attr' => [
                        'class' => 'scenario-inquest-sortorder',
                    ]
                ])
                ->add('scenarioInquestValidators', CollectionType::class, [
                    'label' => 'Validators',
                    'entry_type' => ScenarioInquestValidatorType::class,
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'attr' => [
                        'class' => 'scenario-inquest-validators',
                    ]
                ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ScenarioInquest'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_scenarioinquest';
    }


}
