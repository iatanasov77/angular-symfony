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
            ->add('fields', 'entity', array(
                'mapped' => false,
                'multiple' => true,
                'by_reference' => false,
               'class' => 'IAWebContentThiefBundle:FieldsetField'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IA\Bundle\WebContentThiefBundle\Entity\Fieldset'
        ));
    }

}
