<?php

namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use IA\Bundle\WebContentThiefBundle\Form\Elements\FieldsetFieldType;

class FieldsetType extends AbstractType
{

    public function getName()
    {
        return 'FormFieldset';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('active', 'checkbox', array('label' => 'Active'))
            ->add('title', 'text', array('label' => 'Title'))
            ->add('fields', 'collection', array(
                'type'         => new FieldsetFieldType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'prototype'    => true,
                'by_reference' => false
            ))
            ->add('btnSave', 'submit', array('label' => 'Save'))
            ->add('btnCancel', 'button', array('label' => 'Cancel'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefaults(array(
//            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Fieldset'
//        ));
    }

}
