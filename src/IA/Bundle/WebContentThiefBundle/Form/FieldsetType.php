<?php

namespace IA\Bundle\WebContentThiefBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FieldsetType extends AbstractType
{

    public function getName()
    {
        return 'FormFieldset';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('title', 'text')
            ->add('fields', 'collection', array(
                'type'      => new FieldsetFieldType(),
                'allow_add' => true,
                //'prototype' => true,
                // Post update
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
