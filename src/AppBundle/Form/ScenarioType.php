<?php

namespace AppBundle\Form;

use AppBundle\Entity\Site;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScenarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description')
                ->add('site', EntityType::class, [
                    'placeholder' => 'Choose a site',
                    'required' => false,
                    'class' => 'AppBundle\Entity\Site'
                ]);

        $formModifier = function (FormInterface $form, Site $site = null) {
            if ($site) {
                $form->add('scenarioInquests', CollectionType::class, [
                    'label' => 'Scenario Inquests',
                    'entry_type' => ScenarioInquestType::class,
                    'entry_options' => [
                        'attr' => [
                            'data-site_id' => $site->getId()
                        ]                        
                    ],
                    'allow_add'    => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ]);
            }
        };

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formModifier) {
            $data = $event->getData();
            $formModifier($event->getForm(), $data->getSite());
        });

        $builder->get('site')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                $site = $event->getForm()->getData();

                $formModifier($event->getForm()->getParent(), $site);
            }
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Scenario',
            'site' => 'lala'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_scenario';
    }


}
