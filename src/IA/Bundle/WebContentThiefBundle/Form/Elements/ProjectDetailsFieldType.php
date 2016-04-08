<?php

namespace IA\Bundle\WebContentThiefBundle\Form\Elements;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectDetailsFieldType extends AbstractType
{

    public function getName()
    {
        return 'FormProjectField';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('required' => false))
            ->add('type', 'entity', array(
                'class' => 'IA\Bundle\WebContentThiefBundle\Entity\FieldType',
                'choice_label' => 'title'
            ))
            ->add('xquery', 'text', array('required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\ProjectDetailsField'
        ));
    }

}

